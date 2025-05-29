<?php

namespace app\controllers;

use app\core\Controller;

class CustomerController extends Controller {

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('auth/login');
            exit;
        }
        if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'customer') {
            $_SESSION['flash_message'] = 'You are not authorized to access this page.';
            $_SESSION['flash_type'] = 'danger';
            $this->redirect('home'); // Or a more appropriate page
            exit;
        }
    }

    public function index() {
        $data = [
            'title' => 'Customer Dashboard',
            'welcome_message' => 'Welcome to your Dashboard, ' . htmlspecialchars($_SESSION['username']) . '!'
        ];
        $this->view('customer/index', $data);
    }

    // Other customer-specific methods can be added here
    // e.g., viewMyBookings, updateProfile, etc.
}
