<?php
require_once __DIR__ . '/../models/Venta.php';
require_once __DIR__ . '/../models/Cliente.php';
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Sucursal.php'; // <--- Nuevo modelo

class VentaController {
    public function index() {
        $prodModel = new Producto();
        $cliModel = new Cliente();
        $sucModel = new Sucursal(); // <--- Instanciar sucursal
        
        $productos = $prodModel->listar(); 
        $clientes = $cliModel->listar();
        $sucursales = $sucModel->listar(); // <--- Obtener sucursales
        
        $titulo = "Nueva Venta";
        $seccion_activa = true;
        require_once __DIR__ . '/../views/ventas/nueva.php';
    }

    public function guardar() {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if ($data) {
            $modelo = new Venta();
            // El $data ya debe traer el id_sucursal desde el JS
            $idVenta = $modelo->guardar($data);
            
            echo json_encode(['status' => 'ok', 'id_venta' => $idVenta]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se recibieron datos']);
        }
        exit;
    }
    public function imprimir() {
    $id = $_GET['id'];
    $modelo = new Venta();
    
    // Necesitas crear estos métodos en tu modelo Venta para traer la info
    $venta = $modelo->obtenerVentaPorId($id); 
    $detalle = $modelo->obtenerDetallePorId($id);
    
    // Cargamos una vista limpia (sin header ni sidebar del sistema)
    require_once __DIR__ . '/../views/ventas/ticket.php';
}
}