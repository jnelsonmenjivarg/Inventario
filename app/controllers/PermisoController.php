<?php
require_once __DIR__ . '/../models/Rol.php';
require_once __DIR__ . '/../models/Opcion.php';
require_once __DIR__ . '/../models/RolOpcion.php';

class PermisoController {
    
    public function index() {
        $rolModel = new Rol();
        $opcionModel = new Opcion();
        $rolOpcionModel = new RolOpcion();

        $id_rol = $_GET['id_rol'] ?? null;
        
        $roles = $rolModel->listar();
        $opciones = $opcionModel->listar();
        $permisosActuales = $id_rol ? $rolOpcionModel->obtenerPermisosPorRol($id_rol) : [];

        $titulo = "Asignación de Permisos";
        $seccion_activa = true;

        require_once __DIR__ . '/../views/permisos/index.php';
    }

    public function guardar() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_rol = $_POST['id_rol'];
        $opciones = $_POST['opciones'] ?? [];

        $modelo = new RolOpcion();
        $exito = $modelo->guardarPermisos($id_rol, $opciones);

        if ($exito) {
            header("Location: /permisos?id_rol=" . $id_rol . "&msj=ok");
        } else {
            echo "Error al guardar los permisos.";
        }
        exit;
    }
}
}