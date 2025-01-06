<?php

// Load Configuration
require_once '../config/config.php';
require_once '../app/core/Helper.php';
// boot up mvc
require_once '../app/core/Router.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Model.php';
require_once '../app/core/ErrorHandler.php';

// Set Debug Mode
if (defined('DEBUG_MODE') && DEBUG_MODE) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);
}

// Set Custom Exception Handler
set_exception_handler(function ($exception) {
    if (defined('DEBUG_MODE') && DEBUG_MODE) {
        // Detailed error for debugging
        echo "<h1>Exception: " . $exception->getMessage() . "</h1>";
        echo "<p>File: " . $exception->getFile() . " on line " . $exception->getLine() . "</p>";
        echo "<pre>Stack Trace:<br>" . $exception->getTraceAsString() . "</pre>";
    } else {
        // Generic error for production
        http_response_code(500);
        require '../app/views/errors/500.php';
    }
});

// Set Custom Error Handler
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    if (defined('DEBUG_MODE') && DEBUG_MODE) {
        // Detailed error for debugging
        echo "<h1>Error [$errno]: $errstr</h1>";
        echo "<p>File: $errfile on line $errline</p>";
    } else {
        // Generic error for production
        http_response_code(500);
        require '../app/views/errors/500.php';
    }
});

// Autoload Controllers and Models
spl_autoload_register(function ($class) {
    $controllerPath = "../app/controllers/{$class}.php";
    $modelPath = "../app/models/{$class}.php";

    if (file_exists($controllerPath)) {
        require_once $controllerPath;
    } elseif (file_exists($modelPath)) {
        require_once $modelPath;
    } else {
        if (defined('DEBUG_MODE') && DEBUG_MODE) {
            echo "<h1>Class Not Found: $class</h1>";
        } else {
            ErrorHandler::modelNotFound($class);
        }
        exit;
    }
});

// Initialize Router
$router = new Router();

// Include Routes
$routes = require_once '../routes/web.php';
$routes($router);
// Dispatch the Request
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->dispatch($url);
