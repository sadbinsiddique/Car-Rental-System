<?php
// Turn on error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Autoload classes (PSR-4 style)
spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . '/..';
    $file = $baseDir . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Start the application
$app = new app\core\App();
$app->run();