<?php

namespace app\controllers;

use app\core\Controller;

class DriverController extends Controller {

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('auth/login');
            exit;
        }
        if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'driver') {
            $_SESSION['flash_message'] = 'You are not authorized to access this page.';
            $_SESSION['flash_type'] = 'danger';
            $this->redirect('home'); // Or a more appropriate page
            exit;
        }
    }

    public function index() {
        $data = [
            'title' => 'Driver Dashboard',
            'welcome_message' => 'Welcome to your Driver Dashboard, ' . htmlspecialchars($_SESSION['username']) . '!'
        ];
        $this->view('driver/index', $data);
    }

    // Other driver-specific methods can be added here
    // e.g., viewAssignedTrips, updateAvailability, etc.
}
