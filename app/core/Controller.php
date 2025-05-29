<?php

namespace app\core;

class Controller {
    
    public function view($view, $data = []) {
        extract($data);
        require_once '../app/views/' . $view . '.php';
    }

    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        $modelClass = 'app\\models\\' . $model;
        return new $modelClass();
    }

    public function redirect($location) {
        // Prepend public base path for correct routing
        $baseUrl = '/Car-Rental-System/public';
        header('Location: ' . $baseUrl . '/' . ltrim($location, '/'));
        exit();
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function requireAuth() {
        if (!$this->isLoggedIn()) {
            $this->redirect('/auth/login');
        }
    }

    public function requireRole($role) {
        $this->requireAuth();
        if ($_SESSION['user_type'] !== $role) {
            $this->redirect('/dashboard');
        }
    }

    public function json($data, $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
}
