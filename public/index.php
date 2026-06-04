<?php
session_start();

// 1. Carga de Base de Datos y conexión global
require_once __DIR__ . '/../app/core/Database.php'; 
$GLOBALS['db'] = Database::getConnection(); 

// 2. Cargar las rutas
$routes = require_once __DIR__ . '/../config/routes.php';

// 3. Obtener la URL
$url = $_GET['url'] ?? '';
$url = trim($url, '/');

// 4. Lógica del Enrutador
if (isset($routes[$url])) {
    $controllerName = $routes[$url]['controller'];
    $method = $routes[$url]['method'];

    $controllerPath = __DIR__ . '/../app/controllers/' . $controllerName . '.php';

    if (file_exists($controllerPath)) {
        require_once $controllerPath;
        
        // Verificamos si la clase existe antes de instanciarla
        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            $controller->$method();
        } else {
            die("Error Fatall: La clase '$controllerName' no está definida dentro de $controllerPath");
        }
    } else {
        die("Error: El archivo del controlador no existe en $controllerPath");
    }
} else {
    // Si entras a localhost/ solo, redirigir a inventario o mostrar error
    if($url == "") { header("Location: /inventario"); exit; }
    echo "Ruta no encontrada: " . htmlspecialchars($url);
}
