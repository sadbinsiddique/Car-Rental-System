<?php

namespace app\core;

class App {
    protected $controller = 'AuthController';
    protected $method = 'login';
    protected $params = [];

    public function __construct() {
        session_start();
        $this->parseUrl();
    }    public function run() {
        // Check authentication for protected routes
        $this->checkAuthentication();
        
        // Include the controller
        $controllerPath = '../app/controllers/' . $this->controller . '.php';
        
        if (file_exists($controllerPath)) {
            require_once $controllerPath;
            
            // Get the controller class name with namespace
            $controllerClass = 'app\\controllers\\' . $this->controller;
            
            if (class_exists($controllerClass)) {
                $this->controller = new $controllerClass;
                
                // Check if method exists
                if (method_exists($this->controller, $this->method)) {
                    call_user_func_array([$this->controller, $this->method], $this->params);
                } else {
                    $this->show404();
                }
            } else {
                $this->show404();
            }
        } else {
            $this->show404();
        }
    }

    private function parseUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            // Set controller
            if (isset($url[0]) && !empty($url[0])) {
                $this->controller = ucfirst($url[0]) . 'Controller';
                unset($url[0]);
            }

            // Set method
            if (isset($url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }

            // Set parameters
            $this->params = $url ? array_values($url) : [];
        }
    }

    private function show404() {
        http_response_code(404);
        require_once '../app/views/errors/404.php';
    }    private function checkAuthentication() {
        // Define public routes that don't require authentication
        $publicRoutes = [
            'AuthController' => ['login', 'register', 'forgotPassword', 'verifyOTP', 'resetPassword', 'logout'],
            'HomeController' => ['index', 'search'], // Allow HomeController index and search for guests
            'AdminController' => [], 
            'CustomerController' => [],
            'DriverController' => []
        ];
        
        // Define routes that are specifically for admin users
        $adminOnlyRoutes = [
            'AdminController' => ['index'] // Add other admin methods here: 'users', 'vehicles', 'bookings', 'settings', 'reports'
        ];

        // Define routes for customer users
        $customerOnlyRoutes = [
            'CustomerController' => ['index', 'bookings', 'profile'] // Add other customer methods
        ];

        // Define routes for driver/rider/owner users
        $driverOnlyRoutes = [
            'DriverController' => ['index', 'trips', 'availability', 'earnings', 'vehicle'] // Add other driver methods
        ];

        // Check if current route is public
        $isPublicRoute = false;
        if (isset($publicRoutes[$this->controller])) {
            $isPublicRoute = in_array($this->method, $publicRoutes[$this->controller]);
        }
        
        // If user is not logged in and accessing protected route
        if (!isset($_SESSION['user_id']) && !$isPublicRoute) {
            // Redirect to login page
            $this->controller = 'AuthController';
            $this->method = 'login';
            $this->params = [];
            return;
        }
        
        // If user is logged in and accessing login page, redirect to home
        if (isset($_SESSION['user_id']) && $this->controller === 'AuthController' && $this->method === 'login') {
            // header('Location: /home');
            // exit;
            // Use the App instance to redirect to ensure consistency
            // Create a temporary controller instance to use the redirect method
            // This is a bit of a workaround because App itself doesn't have redirect
            // A better long-term solution might be to have a shared Redirect utility or pass App to Controller
            $tempController = new Controller(); 
            $tempController->redirect('home');
            exit;
        }

        // Check if user is trying to access an admin route without admin privileges
        if (isset($adminOnlyRoutes[$this->controller]) && in_array($this->method, $adminOnlyRoutes[$this->controller])) {
            if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
                $this->handleUnauthorizedAccess();
            }
        }

        // Check if user is trying to access a customer route without customer privileges (or admin)
        if (isset($customerOnlyRoutes[$this->controller]) && in_array($this->method, $customerOnlyRoutes[$this->controller])) {
            if (!isset($_SESSION['user_type']) || ($_SESSION['user_type'] !== 'customer' && $_SESSION['user_type'] !== 'admin' && $_SESSION['user_type'] !== 'super_admin')) {
                $this->handleUnauthorizedAccess();
            }
        }

        // Check if user is trying to access a driver route without driver privileges (or admin)
        if (isset($driverOnlyRoutes[$this->controller]) && in_array($this->method, $driverOnlyRoutes[$this->controller])) {
            if (!isset($_SESSION['user_type']) || ($_SESSION['user_type'] !== 'driver' && $_SESSION['user_type'] !== 'rider' && $_SESSION['user_type'] !== 'owner' && $_SESSION['user_type'] !== 'admin' && $_SESSION['user_type'] !== 'super_admin')) {
                 $this->handleUnauthorizedAccess();
            }
        }
    }

    private function handleUnauthorizedAccess() {
        // Set a flash message for unauthorized access
        $_SESSION['flash_message'] = 'You are not authorized to access this page.';
        $_SESSION['flash_type'] = 'danger';
        
        // Redirect to an appropriate page, e.g., home or login
        $tempController = new Controller();
        if (isset($_SESSION['user_id'])) {
            // If user is logged in but not authorized, redirect to their specific dashboard or home
            $userType = $_SESSION['user_type'] ?? 'guest';
            switch ($userType) {
                case 'admin':
                case 'super_admin':
                    $tempController->redirect('admin/index');
                    break;
                case 'customer':
                    $tempController->redirect('customer/index');
                    break;
                case 'driver':
                case 'rider':
                case 'owner':
                    $tempController->redirect('driver/index');
                    break;
                default:
                    $tempController->redirect('home');
                    break;
            }
        } else {
            // If not logged in, redirect to login
            $tempController->redirect('auth/login');
        }
        exit;
    }
}