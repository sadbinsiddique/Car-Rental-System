<?php

namespace app\controllers;

use app\core\Controller;

class AuthController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('User');
    }    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $remember = isset($_POST['remember']);

            // Validate input
            if (empty($email) || empty($password)) {
                $this->view('auth/login', ['error' => 'Email and password are required']);
                return;
            }

            // Authentication - with simple credentials for quick testing
            $user = $this->userModel->authenticate($email, $password);
            
            if ($user) {
                if ($user['status'] === 'frozen' || $user['status'] === 'banned') {
                    $this->view('auth/login', ['error' => 'Account is suspended. Contact administrator.']);
                    return;
                }

                // Set session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_type'] = $user['user_type'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['full_name'] = $user['full_name'];

                // Handle remember me
                if ($remember) {
                    try {
                        $token = $this->userModel->createRememberToken($user['id']);
                        setcookie('remember_token', $token, time() + (30 * 24 * 60 * 60), '/'); // 30 days
                    } catch (\Exception $e) {
                        // Silently continue if token creation fails
                        // We can still log in successfully
                    }
                }

                // Try to create session record, but don't fail if it doesn't work
                try {
                    $this->userModel->createSession($user['id']);
                } catch (\Exception $e) {
                    // Log error but continue
                    error_log("Failed to create session record: " . $e->getMessage());
                }

                // Role-based redirection
                switch ($user['user_type']) {
                    case 'admin':
                    case 'super_admin': // Assuming super_admin also goes to admin dashboard
                        $this->redirect('admin/index');
                        break;
                    case 'customer':
                        $this->redirect('customer/index');
                        break;
                    case 'driver': // Assuming 'driver' is the role for Riders/Owners
                    case 'rider': 
                    case 'owner':
                        $this->redirect('driver/index');
                        break;
                    default:
                        $this->redirect('home'); // Default redirect if role is not matched
                        break;
                }
                exit;
            } else {
                $this->view('auth/login', ['error' => 'Invalid email or password']);
            }
        } else {
            // Check if already logged in
            if ($this->isLoggedIn()) {
                // Redirect based on role if already logged in
                switch ($_SESSION['user_type']) {
                    case 'admin':
                    case 'super_admin':
                        $this->redirect('admin/index');
                        break;
                    case 'customer':
                        $this->redirect('customer/index');
                        break;
                    case 'driver':
                    case 'rider':
                    case 'owner':
                        $this->redirect('driver/index');
                        break;
                    default:
                        $this->redirect('home');
                        break;
                }
                exit;
            }
            
            // Check remember me cookie
            if (isset($_COOKIE['remember_token'])) {
                try {
                    $user = $this->userModel->getUserByToken($_COOKIE['remember_token']);
                    if ($user) {
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['user_type'] = $user['user_type'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['full_name'] = $user['full_name'];
                        
                        // Role-based redirection from cookie
                        switch ($user['user_type']) {
                            case 'admin':
                            case 'super_admin':
                                $this->redirect('admin/index');
                                break;
                            case 'customer':
                                $this->redirect('customer/index');
                                break;
                            case 'driver':
                            case 'rider':
                            case 'owner':
                                $this->redirect('driver/index');
                                break;
                            default:
                                $this->redirect('home');
                                break;
                        }
                        exit;
                    }
                } catch (\Exception $e) {
                    // Cookie may be invalid, clear it
                    setcookie('remember_token', '', time() - 3600, '/');
                }
            }

            // Display login form - Check for flash messages
            $viewData = [];
            if (isset($_SESSION['flash_message'])) {
                if (isset($_SESSION['flash_type'])) {
                    if ($_SESSION['flash_type'] === 'success') {
                        $viewData['success'] = $_SESSION['flash_message'];
                    } elseif ($_SESSION['flash_type'] === 'danger' || $_SESSION['flash_type'] === 'error') {
                        $viewData['error'] = $_SESSION['flash_message'];
                    } else { // Default for other types or if type not 'success'/'error'
                        $viewData['success'] = $_SESSION['flash_message']; // Or handle as generic info
                    }
                } else { // If flash_type is not set, assume it's a success message
                    $viewData['success'] = $_SESSION['flash_message'];
                }
                unset($_SESSION['flash_message']);
                unset($_SESSION['flash_type']);
            }
            $this->view('auth/login', $viewData);
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'full_name' => trim($_POST['full_name']),
                'user_type' => $_POST['user_type'] ?? 'customer'
            ];

            // Validate input
            $errors = $this->validateRegistration($data);
            
            if (empty($errors)) {
                // Check if user exists
                if ($this->userModel->userExists($data['email'], $data['username'])) {
                    $errors[] = 'User with this email or username already exists';
                } else {
                    // Create user
                    $userId = $this->userModel->createUser($data);
                    
                    if ($userId) {
                        // Handle different user types
                        $this->handleUserTypeRegistration($userId, $data);
                        
                        // Set success notification and redirect to login
                        $_SESSION['flash_message'] = 'Registration successful! You can now log in.';
                        $_SESSION['flash_type'] = 'success';
                        $this->redirect('auth/login');
                        return;
                    } else {
                        $errors[] = 'Registration failed. Please try again.';
                    }
                }
            }
            
            $this->view('auth/register', ['errors' => $errors, 'data' => $data]);
        } else {
            $this->view('auth/register');
        }
    }

    public function logout() {
        // Clear remember token if exists
        if (isset($_COOKIE['remember_token'])) {
            $this->userModel->update($_SESSION['user_id'], ['remember_token' => null]);
            setcookie('remember_token', '', time() - 3600, '/');
        }
        
        // Destroy session
        session_destroy();
        
        // Redirect to login
        // header('Location: auth/login');
        $this->redirect('auth/login');
        exit;
    }

    /**
     * 3. OTP & Password Reset - Forgot Password
     */
    public function forgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            
            if (!$email) {
                $_SESSION['error'] = 'দয়া করে একটি বৈধ ইমেইল ঠিকানা প্রদান করুন।';
                return $this->view('auth/forgot_password');
            }

            $user = $this->userModel->findWhere('email = ?', [$email]);
            
            if ($user) {
                // Generate 6-digit OTP
                $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
                $expiryTime = date('Y-m-d H:i:s', strtotime('+15 minutes'));
                
                // Store OTP in database
                $this->userModel->db->execute(
                    "UPDATE users SET otp_code = ?, otp_expires_at = ? WHERE email = ?",
                    [$otp, $expiryTime, $email]
                );
                
                // Send OTP via email (simulate email sending)
                $this->sendOTPEmail($email, $otp, $user['full_name']);
                
                $_SESSION['reset_email'] = $email;
                $_SESSION['success'] = 'OTP আপনার ইমেইলে পাঠানো হয়েছে। ১৫ মিনিটের মধ্যে যাচাই করুন।';
                // header('Location: auth/verifyOTP');
                $this->redirect('auth/verifyOTP');
                exit;
            } else {
                $_SESSION['error'] = 'এই ইমেইল ঠিকানাটি আমাদের সিস্টেমে নিবন্ধিত নেই।';
            }
        }
        
        $this->view('auth/forgot_password');
    }

    /**
     * Verify OTP for password reset
     */
    public function verifyOTP() {
        if (!isset($_SESSION['reset_email'])) {
            // header('Location: /auth/forgotPassword');
            $this->redirect('auth/forgotPassword');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $enteredOTP = $_POST['otp'];
            $email = $_SESSION['reset_email'];
            
            $user = $this->userModel->db->fetch(
                "SELECT * FROM users WHERE email = ? AND otp_code = ? AND otp_expires_at > NOW()",
                [$email, $enteredOTP]
            );
            
            if ($user) {
                $_SESSION['otp_verified'] = true;
                $_SESSION['success'] = 'OTP যাচাই সফল। এখন নতুন পাসওয়ার্ড সেট করুন।';
                header('Location: /auth/resetPassword');
                exit;
            } else {
                $_SESSION['error'] = 'OTP ভুল অথবা মেয়াদ শেষ হয়েছে। আবার চেষ্টা করুন।';
            }
        }
        
        $this->view('auth/verify_otp', ['email' => $_SESSION['reset_email']]);
    }

    /**
     * Reset password after OTP verification
     */
    public function resetPassword() {
        if (!isset($_SESSION['reset_email']) || !isset($_SESSION['otp_verified'])) {
            header('Location: /auth/forgotPassword');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            
            if (strlen($password) < 6) {
                $_SESSION['error'] = 'পাসওয়ার্ড কমপক্ষে ৬ অক্ষরের হতে হবে।';
                return $this->view('auth/reset_password');
            }
            
            if ($password !== $confirmPassword) {
                $_SESSION['error'] = 'পাসওয়ার্ড মিলছে না।';
                return $this->view('auth/reset_password');
            }
            
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $email = $_SESSION['reset_email'];
            
            // Update password and clear OTP
            $this->userModel->db->execute(
                "UPDATE users SET password = ?, otp_code = NULL, otp_expires_at = NULL WHERE email = ?",
                [$hashedPassword, $email]
            );
            
            // Clear session data
            unset($_SESSION['reset_email'], $_SESSION['otp_verified']);
            
            $_SESSION['success'] = 'পাসওয়ার্ড সফলভাবে পরিবর্তন হয়েছে। এখন লগইন করুন।';
            header('Location: auth/login');
            exit;
        }
        
        $this->view('auth/reset_password');
    }

    /**
     * Simulate sending OTP email
     */
    private function sendOTPEmail($email, $otp, $fullName) {
        // In production, integrate with actual email service
        // For now, log the OTP for testing
        error_log("OTP for $email ($fullName): $otp");
        
        // You can integrate with services like:
        // - PHPMailer for SMTP
        // - SendGrid API
        // - Amazon SES
        // - Local mail server
        
        return true;
    }

    public function verifyEmail() {
        $token = $_GET['token'] ?? '';
        $email = $_GET['email'] ?? '';
        
        if ($this->userModel->verifyEmail($email, $token)) {
            $this->view('auth/login', ['success' => 'Email verified successfully! You can now login.']);
        } else {
            $this->view('auth/login', ['error' => 'Invalid verification link or email already verified.']);
        }
    }

    private function validateRegistration($data) {
        $errors = [];
        
        if (empty($data['username'])) $errors[] = 'Username is required';
        if (empty($data['email'])) $errors[] = 'Email is required';
        if (empty($data['password'])) $errors[] = 'Password is required';
        if (empty($data['full_name'])) $errors[] = 'Full name is required';
        
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format';
        }
        
        if (strlen($data['password']) < 8) {
            $errors[] = 'Password must be at least 8 characters';
        }
        
        if ($data['password'] !== $data['confirm_password']) {
            $errors[] = 'Passwords do not match';
        }
        
        return $errors;
    }

    private function handleUserTypeRegistration($userId, $data) {
        switch ($data['user_type']) {
            case 'rider':
                // Handle rider-specific data if provided
                if (isset($_FILES['license_photo']) || isset($_POST['license_number'])) {
                    $this->userModel->createRiderProfile($userId, $data);
                }
                break;
            case 'owner':
                // Handle owner-specific data if provided
                if (isset($_POST['business_name']) || isset($_FILES['business_license'])) {
                    $this->userModel->createOwnerProfile($userId, $data);
                }
                break;
            default:
                // Customer profile
                $this->userModel->createCustomerProfile($userId, $data);
                break;
        }
    }    private function redirectToDashboard($userType) {
        // For now, redirect all users to home page after login
        // Later you can implement role-based dashboard routing
        $this->redirect('/home');
        
        /* Role-based dashboard routing (for future use):
        switch ($userType) {
            case 'super_admin':
            case 'admin':
                $this->redirect('/admin/dashboard');
                break;
            case 'rider':
                $this->redirect('/rider/dashboard');
                break;
            case 'owner':
                $this->redirect('/owner/dashboard');
                break;
            default:
                $this->redirect('/customer/dashboard');
                break;
        }
        */
    }

    private function sendVerificationEmail($email, $userId) {
        // In a real application, implement email sending logic here
        // For now, we'll just log it
        error_log("Verification email sent to: $email for user ID: $userId");
    }

    private function sendPasswordResetEmail($email, $otp) {
        // In a real application, implement email sending logic here
        // For now, we'll just log it
        error_log("Password reset OTP sent to: $email, OTP: $otp");
    }
}
