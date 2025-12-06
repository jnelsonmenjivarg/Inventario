<?php

require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/Helpers.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../models/Usuario.php';

class UsuariosController
{
    
    
    /**
     * Listado de usuarios
     */
    public function index()
    {
        Permission::requireRole([1]); // Solo admin
        
        Auth::requireLogin();

        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->all();   // trae usuarios + rol (texto)

        require __DIR__ . '/../views/usuarios/index.php';
    }

    /**
     * Crear usuario
     */
    public function crear()
    {
        Auth::requireLogin();

        $db = Database::getConnection();
        $roles = $db->query("SELECT id_rol, descripcion FROM Roles ORDER BY descripcion")
                    ->fetchAll(PDO::FETCH_ASSOC);

        $errores = [];

        if (Helpers::isPost()) {
            $nombre    = Helpers::sanitize($_POST['nombre'] ?? '');
            $email     = Helpers::sanitize($_POST['email'] ?? '');
            $password  = $_POST['password'] ?? '';
            $password2 = $_POST['password_confirmation'] ?? '';
            $idRol     = (int)($_POST['id_rol'] ?? 0);

            if ($nombre === '') {
                $errores[] = 'El nombre es obligatorio.';
            }
            if ($email === '') {
                $errores[] = 'El email es obligatorio.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores[] = 'El email no tiene un formato válido.';
            }
            if ($password === '') {
                $errores[] = 'La contraseña es obligatoria.';
            }
            if ($password !== $password2) {
                $errores[] = 'Las contraseñas no coinciden.';
            }
            if ($idRol <= 0) {
                $errores[] = 'Debe seleccionar un rol.';
            }

            if (empty($errores)) {
                $usuarioModel = new Usuario();
                $usuarioModel->create([
                    'nombre'  => $nombre,
                    'email'   => $email,
                    'password'=> $password,
                    'id_rol'  => $idRol,
                ]);

                Helpers::redirect('usuarios');
            }
        }

        // Vista de crear
        $usuario = null; // por compatibilidad con la vista
        require __DIR__ . '/../views/usuarios/crear.php';
    }

    /**
     * Editar usuario
     */
    public function editar()
    {
        Auth::requireLogin();

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id <= 0) {
            Helpers::redirect('usuarios');
        }

        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->find($id);
        if (!$usuario) {
            Helpers::redirect('usuarios');
        }

        $db = Database::getConnection();
        $roles = $db->query("SELECT id_rol, descripcion FROM Roles ORDER BY descripcion")
                    ->fetchAll(PDO::FETCH_ASSOC);

        // Rol actual del usuario
        $stmt = $db->prepare("SELECT id_rol FROM Usuario_Roles WHERE id_usuario = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        $rolActualId = $stmt->fetchColumn();

        $errores = [];

        if (Helpers::isPost()) {
            $nombre    = Helpers::sanitize($_POST['nombre'] ?? '');
            $email     = Helpers::sanitize($_POST['email'] ?? '');
            $password  = $_POST['password'] ?? '';
            $password2 = $_POST['password_confirmation'] ?? '';
            $idRol     = (int)($_POST['id_rol'] ?? 0);

            if ($nombre === '') {
                $errores[] = 'El nombre es obligatorio.';
            }
            if ($email === '') {
                $errores[] = 'El email es obligatorio.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores[] = 'El email no tiene un formato válido.';
            }
            if ($password !== '' && $password !== $password2) {
                $errores[] = 'Las contraseñas no coinciden.';
            }
            if ($idRol <= 0) {
                $errores[] = 'Debe seleccionar un rol.';
            }

            if (empty($errores)) {
                $data = [
                    'nombre' => $nombre,
                    'email'  => $email,
                    'id_rol' => $idRol,
                ];

                if ($password !== '') {
                    $data['password'] = $password; // Usuario::update la hashea
                }

                $usuarioModel->update($id, $data);
                Helpers::redirect('usuarios');
            }
        }

        require __DIR__ . '/../views/usuarios/editar.php';
    }

    /**
     * Eliminar usuario
     */
    public function eliminar()
    {
        Auth::requireLogin();

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id > 0) {
            $usuarioModel = new Usuario();
            $usuarioModel->delete($id);
        }

        Helpers::redirect('usuarios');
    }
}
