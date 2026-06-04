<?php
require_once __DIR__ . '/../models/Proveedor.php';

class ProveedorController {
    public function index() {
        $modelo = new Proveedor();
        $proveedores = $modelo->listar();
        
        $titulo = "Gestión de Proveedores";
        $seccion_activa = true; 
        
        require_once __DIR__ . '/../views/proveedores/index.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modelo = new Proveedor();
            $modelo->guardar($_POST);
            header("Location: /proveedores");
        }
    }

    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $modelo = new Proveedor();
            $modelo->eliminar($id);
        }
        header("Location: /proveedores");
    }
}