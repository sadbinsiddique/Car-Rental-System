<?php

namespace app\controllers;

use app\core\Controller;

class HomeController extends Controller {
    private $vehicleModel;
    private $userModel;

    public function __construct() {
        $this->vehicleModel = $this->model('Vehicle');
        $this->userModel = $this->model('User');
    }

    public function index() {
        // Check if user is logged in via session or remember me cookie
        if (!$this->isLoggedIn() && isset($_COOKIE['remember_token'])) {
            $user = $this->userModel->getUserByToken($_COOKIE['remember_token']);
            if ($user && $user['status'] === 'active') {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_type'] = $user['user_type'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['full_name'] = $user['full_name'];

                // Add role-based redirect here as well if a user lands on home with a cookie
                // but should be on their specific dashboard.
                switch ($_SESSION['user_type']) {
                    case 'admin':
                    case 'super_admin':
                        $this->redirect('admin/index');
                        exit;
                    case 'customer':
                        $this->redirect('customer/index');
                        exit;
                    case 'driver':
                    case 'rider':
                    case 'owner':
                        $this->redirect('driver/index');
                        exit;
                }
            }
        } else if ($this->isLoggedIn()) {
            // If logged in via session, also check if they should be on a dashboard
            switch ($_SESSION['user_type']) {
                case 'admin':
                case 'super_admin':
                    $this->redirect('admin/index');
                    exit;
                case 'customer':
                    $this->redirect('customer/index');
                    exit;
                case 'driver':
                case 'rider':
                case 'owner':
                    $this->redirect('driver/index');
                    exit;
                // No default redirect to home here, as they might be intentionally on home
                // or their role doesn't have a specific dashboard yet.
            }
        }

        $data = [
            'isLoggedIn' => $this->isLoggedIn(),
            'userType' => $_SESSION['user_type'] ?? null,
            'userName' => $_SESSION['full_name'] ?? null,
            'featuredVehicles' => $this->vehicleModel->getFeaturedVehicles(6),
            'popularBrands' => $this->vehicleModel->getPopularBrands(),
            'totalVehicles' => $this->vehicleModel->getTotalApprovedVehicles(),
            'totalCustomers' => $this->userModel->getTotalCustomers(),
            'totalRides' => $this->userModel->getTotalCompletedRides()
        ];

        $this->view('home/index', $data);
    }

    public function search() {
        $location = $_GET['location'] ?? '';
        $pickupDate = $_GET['pickup_date'] ?? '';
        $dropoffDate = $_GET['dropoff_date'] ?? '';
        $vehicleType = $_GET['vehicle_type'] ?? '';
        
        $vehicles = $this->vehicleModel->searchVehicles([
            'location' => $location,
            'pickup_date' => $pickupDate,
            'dropoff_date' => $dropoffDate,
            'vehicle_type' => $vehicleType
        ]);

        $data = [
            'vehicles' => $vehicles,
            'searchParams' => [
                'location' => $location,
                'pickup_date' => $pickupDate,
                'dropoff_date' => $dropoffDate,
                'vehicle_type' => $vehicleType
            ]
        ];

        $this->view('home/search-results', $data);
    }

    public function about() {
        $this->view('home/about');
    }

    public function contact() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $subject = trim($_POST['subject']);
            $message = trim($_POST['message']);

            $errors = [];
            if (empty($name)) $errors[] = 'Name is required';
            if (empty($email)) $errors[] = 'Email is required';
            if (empty($message)) $errors[] = 'Message is required';
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email format';

            if (empty($errors)) {
                // In a real application, send email or save to database
                $this->view('home/contact', ['success' => 'Thank you for your message. We will get back to you soon.']);
                return;
            }

            $this->view('home/contact', ['errors' => $errors]);
        } else {
            $this->view('home/contact');
        }
    }
}
