<?php
require_once __DIR__ . '/../models/Rol.php';

class RolController {

public function index() {
    $modelo = new Rol();
    $roles = $modelo->listar();
    
    $titulo = "Gestión de Roles";
    $seccion_activa = true; 
    
    require_once __DIR__ . '/../views/roles/index.php';
}

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modelo = new Rol();
            $modelo->guardar($_POST);
            header("Location: /roles");
        }
    }

    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $modelo = new Rol();
            $modelo->borrar($id);
        }
        header("Location: /roles");
    }
}