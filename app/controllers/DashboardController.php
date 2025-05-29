<?php

namespace app\controllers;

use app\core\Controller;

class DashboardController extends Controller {
    private $userModel;
    private $bookingModel;
    private $vehicleModel;

    public function __construct() {
        $this->requireAuth();
        $this->userModel = $this->model('User');
        $this->bookingModel = $this->model('Booking');
        $this->vehicleModel = $this->model('Vehicle');
        
        // Update session activity
        $this->userModel->updateSessionActivity($_SESSION['user_id']);
    }

    public function index() {
        $userType = $_SESSION['user_type'];
        
        switch ($userType) {
            case 'super_admin':
            case 'admin':
                $this->adminDashboard();
                break;
            case 'customer':
                $this->customerDashboard();
                break;
            case 'rider':
                $this->riderDashboard();
                break;
            case 'owner':
                $this->ownerDashboard();
                break;
            default:
                $this->redirect('/auth/login');
                break;
        }
    }

    private function adminDashboard() {
        $data = [
            'totalUsers' => $this->userModel->db->fetch("SELECT COUNT(*) as count FROM users")['count'],
            'totalCustomers' => $this->userModel->db->fetch("SELECT COUNT(*) as count FROM users WHERE user_type = 'customer'")['count'],
            'totalRiders' => $this->userModel->db->fetch("SELECT COUNT(*) as count FROM users WHERE user_type = 'rider'")['count'],
            'totalOwners' => $this->userModel->db->fetch("SELECT COUNT(*) as count FROM users WHERE user_type = 'owner'")['count'],
            'totalVehicles' => $this->vehicleModel->db->fetch("SELECT COUNT(*) as count FROM vehicles")['count'],
            'pendingVehicles' => $this->vehicleModel->db->fetch("SELECT COUNT(*) as count FROM vehicles WHERE status = 'pending'")['count'],
            'totalBookings' => $this->bookingModel->db->fetch("SELECT COUNT(*) as count FROM bookings")['count'],
            'activeBookings' => $this->bookingModel->db->fetch("SELECT COUNT(*) as count FROM bookings WHERE status IN ('confirmed', 'in_progress')")['count'],
            'totalRevenue' => $this->bookingModel->db->fetch("SELECT SUM(final_price) as total FROM bookings WHERE status = 'completed'")['total'] ?? 0,
            'adminCommission' => $this->bookingModel->db->fetch("SELECT SUM(admin_commission) as total FROM payments WHERE payment_status = 'completed'")['total'] ?? 0,
            'recentBookings' => $this->bookingModel->getRecentBookings(10),
            'pendingDamageReports' => $this->getDamageReports('reported'),
            'recentUsers' => $this->userModel->db->fetchAll("SELECT * FROM users ORDER BY created_at DESC LIMIT 10")
        ];

        $this->view('admin/dashboard', $data);
    }

    private function customerDashboard() {
        $customerId = $_SESSION['user_id'];
        
        $data = [
            'profile' => $this->userModel->getUserProfile($customerId),
            'recentBookings' => $this->bookingModel->getCustomerBookings($customerId, 5),
            'activeBookings' => $this->bookingModel->getCustomerActiveBookings($customerId),
            'totalBookings' => $this->bookingModel->db->fetch("SELECT COUNT(*) as count FROM bookings WHERE customer_id = ?", [$customerId])['count'],
            'totalSpent' => $this->bookingModel->db->fetch("SELECT SUM(final_price) as total FROM bookings WHERE customer_id = ? AND status = 'completed'", [$customerId])['total'] ?? 0,
            'availableVehicles' => $this->vehicleModel->getAvailableVehicles(6),
            'notifications' => $this->getNotifications($customerId, 5)
        ];

        $this->view('customer/dashboard', $data);
    }

    private function riderDashboard() {
        $riderId = $_SESSION['user_id'];
        
        $data = [
            'profile' => $this->userModel->getUserProfile($riderId),
            'pendingBookings' => $this->bookingModel->getRiderPendingBookings($riderId),
            'activeBookings' => $this->bookingModel->getRiderActiveBookings($riderId),
            'completedBookings' => $this->bookingModel->getRiderCompletedBookings($riderId, 5),
            'totalRides' => $this->bookingModel->db->fetch("SELECT COUNT(*) as count FROM bookings WHERE rider_id = ? AND status = 'completed'", [$riderId])['count'],
            'totalEarnings' => $this->bookingModel->db->fetch("SELECT SUM(rider_amount) as total FROM payments WHERE rider_id = ? AND payment_status = 'completed'", [$riderId])['total'] ?? 0,
            'averageRating' => $this->getRiderAverageRating($riderId),
            'recentRatings' => $this->getRiderRecentRatings($riderId, 5),
            'notifications' => $this->getNotifications($riderId, 5)
        ];

        $this->view('rider/dashboard', $data);
    }

    private function ownerDashboard() {
        $ownerId = $_SESSION['user_id'];
        
        $data = [
            'profile' => $this->userModel->getUserProfile($ownerId),
            'vehicles' => $this->vehicleModel->getOwnerVehicles($ownerId),
            'totalVehicles' => $this->vehicleModel->db->fetch("SELECT COUNT(*) as count FROM vehicles WHERE owner_id = ?", [$ownerId])['count'],
            'approvedVehicles' => $this->vehicleModel->db->fetch("SELECT COUNT(*) as count FROM vehicles WHERE owner_id = ? AND status = 'approved'", [$ownerId])['count'],
            'pendingVehicles' => $this->vehicleModel->db->fetch("SELECT COUNT(*) as count FROM vehicles WHERE owner_id = ? AND status = 'pending'", [$ownerId])['count'],
            'totalBookings' => $this->vehicleModel->getOwnerTotalBookings($ownerId),
            'totalRevenue' => $this->vehicleModel->getOwnerTotalRevenue($ownerId),
            'recentBookings' => $this->vehicleModel->getOwnerRecentBookings($ownerId, 5),
            'vehicleRatings' => $this->getOwnerVehicleRatings($ownerId),
            'notifications' => $this->getNotifications($ownerId, 5)
        ];

        $this->view('owner/dashboard', $data);
    }

    public function profile() {
        $userId = $_SESSION['user_id'];
        $profile = $this->userModel->getUserProfile($userId);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $errors = $this->validateProfileUpdate($data);
            
            if (empty($errors)) {
                $updated = $this->updateUserProfile($userId, $data);
                if ($updated) {
                    $this->view('dashboard/profile', ['success' => 'Profile updated successfully', 'profile' => $this->userModel->getUserProfile($userId)]);
                    return;
                } else {
                    $errors[] = 'Failed to update profile';
                }
            }
            
            $this->view('dashboard/profile', ['errors' => $errors, 'profile' => $profile]);
        } else {
            $this->view('dashboard/profile', ['profile' => $profile]);
        }
    }

    public function changePassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $currentPassword = $_POST['current_password'];
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];
            
            $errors = [];
            
            // Validate current password
            $user = $this->userModel->findById($_SESSION['user_id']);
            if (!password_verify($currentPassword, $user['password'])) {
                $errors[] = 'Current password is incorrect';
            }
            
            if (strlen($newPassword) < 8) {
                $errors[] = 'New password must be at least 8 characters';
            }
            
            if ($newPassword !== $confirmPassword) {
                $errors[] = 'New passwords do not match';
            }
            
            if (empty($errors)) {
                if ($this->userModel->updatePassword($_SESSION['user_id'], $newPassword)) {
                    $this->view('dashboard/change-password', ['success' => 'Password changed successfully']);
                    return;
                } else {
                    $errors[] = 'Failed to change password';
                }
            }
            
            $this->view('dashboard/change-password', ['errors' => $errors]);
        } else {
            $this->view('dashboard/change-password');
        }
    }

    public function notifications() {
        $userId = $_SESSION['user_id'];
        $page = $_GET['page'] ?? 1;
        $limit = 20;
        $offset = ($page - 1) * $limit;
        
        $notifications = $this->userModel->db->fetchAll(
            "SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC LIMIT ? OFFSET ?",
            [$userId, $limit, $offset]
        );
        
        $totalNotifications = $this->userModel->db->fetch(
            "SELECT COUNT(*) as count FROM notifications WHERE user_id = ?",
            [$userId]
        )['count'];
        
        // Mark notifications as read
        $this->userModel->db->query(
            "UPDATE notifications SET is_read = TRUE WHERE user_id = ?",
            [$userId]
        );
        
        $data = [
            'notifications' => $notifications,
            'currentPage' => $page,
            'totalPages' => ceil($totalNotifications / $limit)
        ];
        
        $this->view('dashboard/notifications', $data);
    }

    private function getNotifications($userId, $limit = 10) {
        return $this->userModel->db->fetchAll(
            "SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC LIMIT ?",
            [$userId, $limit]
        );
    }

    private function getDamageReports($status = null) {
        $sql = "SELECT dr.*, b.pickup_location, b.dropoff_location, u.full_name as customer_name, v.name as vehicle_name 
                FROM damage_reports dr 
                JOIN bookings b ON dr.booking_id = b.id 
                JOIN users u ON dr.customer_id = u.id 
                JOIN vehicles v ON dr.vehicle_id = v.id";
        
        $params = [];
        if ($status) {
            $sql .= " WHERE dr.status = ?";
            $params[] = $status;
        }
        
        $sql .= " ORDER BY dr.created_at DESC LIMIT 10";
        
        return $this->userModel->db->fetchAll($sql, $params);
    }

    private function getRiderAverageRating($riderId) {
        $result = $this->userModel->db->fetch(
            "SELECT AVG(rider_rating) as avg_rating FROM ratings WHERE rider_id = ?",
            [$riderId]
        );
        return round($result['avg_rating'] ?? 0, 2);
    }

    private function getRiderRecentRatings($riderId, $limit) {
        return $this->userModel->db->fetchAll(
            "SELECT r.*, u.full_name as customer_name, v.name as vehicle_name 
             FROM ratings r 
             JOIN users u ON r.customer_id = u.id 
             JOIN vehicles v ON r.vehicle_id = v.id 
             WHERE r.rider_id = ? 
             ORDER BY r.created_at DESC LIMIT ?",
            [$riderId, $limit]
        );
    }

    private function getOwnerVehicleRatings($ownerId) {
        return $this->userModel->db->fetchAll(
            "SELECT v.name, AVG(r.vehicle_rating) as avg_rating, COUNT(r.id) as total_ratings
             FROM vehicles v 
             LEFT JOIN ratings r ON v.id = r.vehicle_id 
             WHERE v.owner_id = ? 
             GROUP BY v.id, v.name
             ORDER BY avg_rating DESC",
            [$ownerId]
        );
    }

    private function validateProfileUpdate($data) {
        $errors = [];
        
        if (empty($data['full_name'])) {
            $errors[] = 'Full name is required';
        }
        
        if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format';
        }
        
        return $errors;
    }

    private function updateUserProfile($userId, $data) {
        // Update user table
        $userData = [
            'full_name' => $data['full_name'],
            'phone' => $data['phone'] ?? null
        ];
        
        if (!empty($data['email'])) {
            $userData['email'] = $data['email'];
        }
        
        $this->userModel->update($userId, $userData);
        
        // Update profile table based on user type
        $user = $this->userModel->findById($userId);
        
        switch ($user['user_type']) {
            case 'customer':
                return $this->updateCustomerProfile($userId, $data);
            case 'rider':
                return $this->updateRiderProfile($userId, $data);
            case 'owner':
                return $this->updateOwnerProfile($userId, $data);
        }
        
        return true;
    }

    private function updateCustomerProfile($userId, $data) {
        $profileData = [
            'address' => $data['address'] ?? null,
            'emergency_contact' => $data['emergency_contact'] ?? null
        ];
        
        if (!empty($data['date_of_birth'])) {
            $profileData['date_of_birth'] = $data['date_of_birth'];
        }
        
        if (!empty($data['gender'])) {
            $profileData['gender'] = $data['gender'];
        }
        
        return $this->userModel->db->update('customer_profiles', $profileData, 'user_id = :user_id', ['user_id' => $userId]);
    }

    private function updateRiderProfile($userId, $data) {
        $profileData = [
            'address' => $data['address'] ?? null,
            'experience_years' => $data['experience_years'] ?? 0,
            'bank_account' => $data['bank_account'] ?? null
        ];
        
        if (!empty($data['license_number'])) {
            $profileData['license_number'] = $data['license_number'];
        }
        
        return $this->userModel->db->update('rider_profiles', $profileData, 'user_id = :user_id', ['user_id' => $userId]);
    }

    private function updateOwnerProfile($userId, $data) {
        $profileData = [
            'business_name' => $data['business_name'] ?? null,
            'address' => $data['address'] ?? null,
            'bank_account' => $data['bank_account'] ?? null
        ];
        
        return $this->userModel->db->update('owner_profiles', $profileData, 'user_id = :user_id', ['user_id' => $userId]);
    }
}
