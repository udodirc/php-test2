<?php
// Autoload core files using namespaces and PSR-4 autoloading
use app\controllers\EmployeeController;
use app\controllers\HomeController;
use core\Router;

spl_autoload_register(function($class) {
    $file = '../' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

$router = new Router();

// Define routes
$router->add('/', [new HomeController(), 'index']);
$router->add('/employees', [new EmployeeController(), 'index']);
$router->add('/employees/create', [new EmployeeController(), 'create']);
$router->add('/employees/store', [new EmployeeController(), 'store']);
$router->add('/employees/edit', [new EmployeeController(), 'edit']);

// Get the requested URL
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Dispatch the route
$router->dispatch($url);
