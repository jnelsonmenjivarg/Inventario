<?php

require_once __DIR__ . '/../models/Inventario.php';

class InventarioController {

public function index() {
    $modelo = new Inventario();
    $productos = $modelo->listar();

    // ESTA LÍNEA ES LA QUE FALTA:
    $proveedores = $GLOBALS['db']->query("SELECT id_proveedor, descripcion_corta FROM proveedores")->fetchAll(PDO::FETCH_ASSOC);
    
    $titulo = "Gestión de Inventario";
    $seccion_activa = true;

    // Pasamos tanto productos como proveedores a la vista
    require_once __DIR__ . '/../views/inventario/index.php';
}
    

public function guardar() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $modelo = new Inventario();
        if (empty($_POST['id'])) {
            $modelo->crear($_POST); // Aquí enviamos todos los campos
        } else {
            $modelo->actualizar($_POST);
        }
        header("Location: /inventario");
    }
}

public function eliminar() {
        // 1. Obtenemos el ID de la URL (ej: ?id=6)
        $id = $_GET['id'] ?? null;

        if ($id) {
            $modelo = new Inventario();
            // 2. Ejecutamos el borrado en el modelo
            $modelo->borrar($id);
        }

        // 3. Redirigimos al listado para refrescar la tabla
        header("Location: /inventario");
        exit;
    }

} // ← cerrar clase