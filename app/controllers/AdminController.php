<?php

namespace app\controllers;

use app\core\Controller;

class AdminController extends Controller {

    public function __construct() {
        // Ensure user is logged in
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('auth/login');
            exit;
        }

        // Ensure user is an admin or super_admin
        if (!isset($_SESSION['user_type']) || !in_array($_SESSION['user_type'], ['admin', 'super_admin'])) {
            // Set a flash message for unauthorized access (handled by App.php or here)
            $_SESSION['flash_message'] = 'You are not authorized to access this page.';
            $_SESSION['flash_type'] = 'danger';
            $this->redirect('home'); // Redirect non-admins/super_admins to the home page
            exit;
        }
    }

    public function index() {
        // This is the main dashboard page for admins
        $data = [
            'title' => 'Admin Dashboard',
            'welcome_message' => 'Welcome to the Admin Dashboard, ' . htmlspecialchars($_SESSION['username']) . '!'
        ];
        $this->view('admin/index', $data);
    }

    // Add other admin-specific methods here later (e.g., manageUsers, manageVehicles, etc.)

}
