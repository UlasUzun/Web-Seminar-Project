<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/db.php';

// Define the base path for views and controllers
define('VIEW_PATH', __DIR__ . '/views/');
define('CONTROLLER_PATH', __DIR__ . '/controllers/');

// Basic Routing
$page = isset($_GET['page']) ? $_GET['page'] : 'main';

// Valid routes (whitelisting for security)
$routes = [
    'main' => 'main.php',
    'images' => 'images.php',
    'contact' => 'contact.php',
    'messages' => 'messages.php',
    'crud' => 'crud.php',
    'login' => 'login.php',
    'logout' => 'logout.php',
    'register' => 'register.php'
];

// Determine the controller file
if (array_key_exists($page, $routes)) {
    $controllerFile = CONTROLLER_PATH . $routes[$page];
    if (file_exists($controllerFile)) {
        require_once $controllerFile;
    } else {
        die("Controller file not found.");
    }
} else {
    // 404 Not Found
    http_response_code(404);
    require_once VIEW_PATH . '404.php';
}
