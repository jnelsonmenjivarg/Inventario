<?php
session_start();

require_once __DIR__ . '/../app/core/Helpers.php';
require_once __DIR__ . '/../app/core/Auth.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/Permission.php';

$GLOBALS['db'] = Database::getConnection();

$routes = require __DIR__ . '/../config/routes.php';

$url = $_GET['url'] ?? '';
$url = trim($url, '/');

if (isset($routes[$url])) {

    [$controllerName, $method] = $routes[$url];

    require_once __DIR__ . '/../app/controllers/' . $controllerName . '.php';

    $controller = new $controllerName();
    $controller->$method();

    exit;
}

http_response_code(404);
echo "Página no encontrada";
