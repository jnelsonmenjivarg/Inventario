<?php

require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/Permission.php';
require_once __DIR__ . '/../core/Helpers.php';
require_once __DIR__ . '/../models/Rol.php';

class RolesController
{
    private $rol;

    public function __construct()
    {
        Auth::requireLogin();
        Permission::requireRole([1]); // SOLO ADMIN
        $this->rol = new Rol();
    }

    public function index()
    {
        $roles = $this->rol->all();
        require __DIR__ . '/../views/roles/index.php';
    }

    public function crear()
    {
        if (Helpers::isPost()) {
            $descripcion = Helpers::sanitize($_POST['descripcion']);

            if (empty($descripcion)) {
                $error = "La descripción del rol es obligatoria.";
                require __DIR__ . '/../views/roles/crear.php';
                return;
            }

            $this->rol->create($descripcion);
            Helpers::redirect('roles');
        }

        require __DIR__ . '/../views/roles/crear.php';
    }

    public function editar()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) Helpers::redirect('roles');

        if (Helpers::isPost()) {
            $descripcion = Helpers::sanitize($_POST['descripcion']);
            $this->rol->update($id, $descripcion);
            Helpers::redirect('roles');
        }

        $rol = $this->rol->find($id);
        require __DIR__ . '/../views/roles/editar.php';
    }

    public function eliminar()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) Helpers::redirect('roles');

        $this->rol->delete($id);
        Helpers::redirect('roles');
    }
}