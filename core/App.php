<?php

namespace core;

class App {
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        session_start();
        $this->parseUrl();
    }

    public function run() {
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
    }
}