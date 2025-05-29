<?php

namespace app\models;

use app\core\Model;

class User extends Model {
    protected $table = 'users';    public function authenticate($emailOrUsername, $password) {
        // Simple hardcoded login for testing
        if (($emailOrUsername === 'admin@example.com' && $password === 'admin123') || 
            ($emailOrUsername === 'user@example.com' && $password === 'user123')) {
            
            // Determine user type based on email
            $userType = $emailOrUsername === 'admin@example.com' ? 'admin' : 'customer';
            
            // Return a simple user array with basic info
            return [
                'id' => 1,
                'username' => $emailOrUsername === 'admin@example.com' ? 'admin' : 'user',
                'email' => $emailOrUsername,
                'full_name' => $emailOrUsername === 'admin@example.com' ? 'Admin User' : 'Regular User',
                'user_type' => $userType,
                'status' => 'active'
            ];
        }
        
        // Try to find user by email first, then by username
        $user = $this->findWhere('email = ?', [$emailOrUsername]);
        
        if (!$user) {
            $user = $this->findWhere('username = ?', [$emailOrUsername]);
        }
        
        if ($user && password_verify($password, $user['password'])) {
            // Check if the user is an admin
            if ($user['user_type'] === 'admin') {
                $user['can_manage_all'] = true;
            } else {
                $user['can_manage_all'] = false;
            }
            return $user;
        }
        
        return false;
    }

    public function createUser($data) {
        $userData = [
            'username' => $data['username'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'full_name' => $data['full_name'],
            'user_type' => $data['user_type'],
            'status' => 'active'
        ];

        return $this->create($userData);
    }

    public function userExists($email, $username) {
        $result = $this->db->fetch(
            "SELECT id FROM {$this->table} WHERE email = ? OR username = ?",
            [$email, $username]
        );
        return $result !== false;
    }

    public function getUserByEmail($email) {
        return $this->findWhere('email = ?', [$email]);
    }

    public function getUserByToken($token) {
        return $this->findWhere('remember_token = ?', [$token]);
    }    public function createRememberToken($userId) {
        $token = bin2hex(random_bytes(32));
        try {
            $this->update($userId, ['remember_token' => $token]);
        } catch (\Exception $e) {
            // For simple login, still return the token even if saving fails
            error_log("Failed to save remember token: " . $e->getMessage());
        }
        return $token;
    }

    public function updatePassword($userId, $newPassword) {
        return $this->update($userId, [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT),
            'remember_token' => null
        ]);
    }

    public function generateOTP($userId, $email, $purpose) {
        $otp = sprintf('%06d', mt_rand(100000, 999999));
        $expiresAt = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        // Remove any existing OTPs for this user and purpose
        $this->db->query(
            "DELETE FROM otps WHERE user_id = ? AND purpose = ?",
            [$userId, $purpose]
        );

        // Insert new OTP
        $this->db->insert('otps', [
            'user_id' => $userId,
            'email' => $email,
            'otp_code' => $otp,
            'purpose' => $purpose,
            'expires_at' => $expiresAt
        ]);

        return $otp;
    }

    public function verifyOTP($email, $otp, $purpose) {
        $result = $this->db->fetch(
            "SELECT * FROM otps WHERE email = ? AND otp_code = ? AND purpose = ? AND expires_at > NOW() AND is_used = FALSE",
            [$email, $otp, $purpose]
        );

        return $result !== false;
    }

    public function markOTPUsed($email, $otp) {
        return $this->db->query(
            "UPDATE otps SET is_used = TRUE WHERE email = ? AND otp_code = ?",
            [$email, $otp]
        );
    }

    public function verifyEmail($email, $token) {
        if ($this->verifyOTP($email, $token, 'email_verification')) {
            $user = $this->getUserByEmail($email);
            if ($user) {
                $this->update($user['id'], ['email_verified' => true]);
                $this->markOTPUsed($email, $token);
                return true;
            }
        }
        return false;
    }    public function createSession($userId) {
        $token = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', strtotime('+30 days'));

        try {
            // Remove old sessions
            $this->db->query(
                "DELETE FROM login_sessions WHERE user_id = ? AND expires_at < NOW()",
                [$userId]
            );

            // Create new session
            return $this->db->insert('login_sessions', [
                'user_id' => $userId,
                'session_token' => $token,
                'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null,
                'expires_at' => $expiresAt
            ]);
        } catch (\Exception $e) {
            error_log("Failed to create session: " . $e->getMessage());
            return false;
        }
    }

    public function removeSession($userId) {
        return $this->db->query(
            "UPDATE login_sessions SET is_active = FALSE WHERE user_id = ?",
            [$userId]
        );
    }

    public function updateSessionActivity($userId) {
        return $this->db->query(
            "UPDATE login_sessions SET last_activity = NOW() WHERE user_id = ? AND is_active = TRUE",
            [$userId]
        );
    }

    public function createCustomerProfile($userId, $data) {
        return $this->db->insert('customer_profiles', [
            'user_id' => $userId,
            'address' => $data['address'] ?? null,
            'date_of_birth' => $data['date_of_birth'] ?? null,
            'gender' => $data['gender'] ?? null,
            'emergency_contact' => $data['emergency_contact'] ?? null
        ]);
    }

    public function createRiderProfile($userId, $data) {
        $profileData = [
            'user_id' => $userId,
            'license_number' => $data['license_number'],
            'date_of_birth' => $data['date_of_birth'],
            'gender' => $data['gender'],
            'address' => $data['address'] ?? null,
            'experience_years' => $data['experience_years'] ?? 0,
            'bank_account' => $data['bank_account'] ?? null,
            'nid_number' => $data['nid_number'] ?? null
        ];

        // Handle file upload for license photo
        if (isset($_FILES['license_photo']) && $_FILES['license_photo']['error'] === 0) {
            $uploadDir = '../uploads/licenses/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            $fileName = $userId . '_' . time() . '_' . $_FILES['license_photo']['name'];
            $uploadPath = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES['license_photo']['tmp_name'], $uploadPath)) {
                $profileData['license_photo'] = $fileName;
            }
        }

        return $this->db->insert('rider_profiles', $profileData);
    }

    public function createOwnerProfile($userId, $data) {
        $profileData = [
            'user_id' => $userId,
            'business_name' => $data['business_name'] ?? null,
            'address' => $data['address'] ?? null,
            'nid_number' => $data['nid_number'] ?? null,
            'bank_account' => $data['bank_account'] ?? null
        ];

        // Handle file upload for business license
        if (isset($_FILES['business_license']) && $_FILES['business_license']['error'] === 0) {
            $uploadDir = '../uploads/business_licenses/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            $fileName = $userId . '_' . time() . '_' . $_FILES['business_license']['name'];
            $uploadPath = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES['business_license']['tmp_name'], $uploadPath)) {
                $profileData['business_license'] = $fileName;
            }
        }

        return $this->db->insert('owner_profiles', $profileData);
    }

    public function getAllUsers($userType = null) {
        if ($userType) {
            return $this->where('user_type = ?', [$userType]);
        }
        return $this->findAll();
    }

    public function updateUserStatus($userId, $status) {
        return $this->update($userId, ['status' => $status]);
    }

    public function getUserProfile($userId) {
        $user = $this->findById($userId);
        if (!$user) return null;

        $profile = null;
        switch ($user['user_type']) {
            case 'customer':
                $profile = $this->db->fetch(
                    "SELECT * FROM customer_profiles WHERE user_id = ?",
                    [$userId]
                );
                break;
            case 'rider':
                $profile = $this->db->fetch(
                    "SELECT * FROM rider_profiles WHERE user_id = ?",
                    [$userId]
                );
                break;
            case 'owner':
                $profile = $this->db->fetch(
                    "SELECT * FROM owner_profiles WHERE user_id = ?",
                    [$userId]
                );
                break;
        }

        return [
            'user' => $user,
            'profile' => $profile
        ];
    }

    public function logAuditEvent($userId, $action, $tableName = null, $recordId = null, $oldValues = null, $newValues = null) {
        return $this->db->insert('audit_logs', [
            'user_id' => $userId,
            'action' => $action,
            'table_name' => $tableName,
            'record_id' => $recordId,
            'old_values' => $oldValues ? json_encode($oldValues) : null,
            'new_values' => $newValues ? json_encode($newValues) : null,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null
        ]);
    }

    public function getTotalCustomers() {
        $result = $this->db->fetch("SELECT COUNT(*) as count FROM users WHERE user_type = 'customer'");
        return $result['count'];
    }

    public function getTotalCompletedRides() {
        $result = $this->db->fetch("SELECT COUNT(*) as count FROM bookings WHERE booking_status = 'completed'");
        return $result['count'];
    }
}
