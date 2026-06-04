<?php
session_start();

require_once __DIR__ . '/../app/core/helpers.php';
require_once __DIR__ . '/../app/core/Auth.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/Permission.php';

// crear conexión global
$GLOBALS['db'] = Database::getConnection();

// rutas
$routes = require __DIR__ . '/../config/routes.php';

$url = $_GET['url'] ?? '';
$url = trim($url, '/');

// si ruta existe...
if (isset($routes[$url])) {

    [$controllerName, $method] = $routes[$url];

    require_once __DIR__ . '/../app/controllers/' . $controllerName . '.php';

    $controller = new $controllerName();
    $controller->$method();
    exit;
}

// sino...
http_response_code(404);
echo "Página no encontrada";
