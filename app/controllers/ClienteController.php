<?php
require_once __DIR__ . '/../models/Cliente.php';

class ClienteController {
    public function index() {
        $modelo = new Cliente();
        $clientes = $modelo->listar();
        
        $titulo = "Gestión de Clientes";
        $seccion_activa = true; 
        
        require_once __DIR__ . '/../views/clientes/index.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modelo = new Cliente();
            $modelo->guardar($_POST);
            header("Location: /clientes");
        }
    }

    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $modelo = new Cliente();
            $modelo->eliminar($id);
        }
        header("Location: /clientes");
    }
}