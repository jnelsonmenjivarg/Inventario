<?php
require_once __DIR__ . '/../models/Usuario.php';

class AuthController {
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new Usuario();
            $user = $model->validarLogin($_POST['email'], $_POST['password']);

            if ($user) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                
                $_SESSION['id_usuario'] = $user['id_usuario'];
                $_SESSION['nombre'] = $user['nombre'];
                $_SESSION['rol'] = $user['rol_nombre'];
                
                // Si NO es administrador, cargamos sus permisos de la tabla rol_opcion
                if ($_SESSION['rol'] != 'admin' && $_SESSION['rol'] != 'administrador') {
                    $_SESSION['menu'] = $model->obtenerPermisos($user['id_usuario']);
                }
                header("Location: /inventario"); // O la página que quieras
                exit;
            } else {
                $error = "Credenciales incorrectas";
                require_once __DIR__ . '/../views/auth/login.php';
            }
        } else {
            require_once __DIR__ . '/../views/auth/login.php';
        }
    }

    public function logout() {
        // Controlar que la sesión esté activa antes de destruirla (evita el Notice)
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Limpiar todas las variables de sesión de la memoria
        $_SESSION = array();
        
        // Destruir la sesión en el servidor
        session_destroy();
        
        // Redirigir al login
        header("Location: /inventario"); // Usa tu ruta base o '/inventario' según manejes tus urls
        exit;
    }
}