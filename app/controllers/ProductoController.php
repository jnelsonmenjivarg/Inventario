<?php
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Proveedor.php';
require_once __DIR__ . '/../models/Sucursal.php';

class ProductoController {
    public function index() {
        $modelo = new Producto();
        $provModel = new Proveedor();
        $sucModel = new Sucursal();

        $productos = $modelo->listar();
        $proveedores = $provModel->listar(); 
        $sucursales = $sucModel->listar();   // Para el select del modal
        
        $titulo = "Inventario de Productos";
        require_once __DIR__ . '/../views/productos/index.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modelo = new Producto();
            $modelo->guardar($_POST);
            header("Location: /productos");
        }
    }
}