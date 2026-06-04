<?php
require_once __DIR__ . '/../models/Opcion.php';

class OpcionController {
    public function index() {
        $modelo = new Opcion();
        $opciones = $modelo->listar();
        
        $titulo = "Mantenimiento de Opciones";
        $seccion_activa = true; 
        
        require_once __DIR__ . '/../views/opciones/index.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modelo = new Opcion();
            $modelo->guardar($_POST);
            header("Location: /opciones");
        }
    }

    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $modelo = new Opcion();
            $modelo->cambiarEstado($id, 0); // Inactivación lógica
        }
        header("Location: /opciones");
    }
}