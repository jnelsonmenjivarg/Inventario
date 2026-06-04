<?php

require_once 'core/helpers.php';
require_once 'models/Venta.php';
require_once 'models/Cliente.php';   // asumiendo que lo tienes
require_once 'models/Producto.php';  // idem


class VentasController
{
    public function index()
    {
        Auth::requireLogin();

        $venta = new Venta();
        $ventas = $venta->all();

        require __DIR__ . '/../views/ventas/index.php';
    }

    public function crear()
    {
        Auth::requireLogin();

        $clientes = $GLOBALS['db']->query("SELECT * FROM Clientes")->fetchAll();
        $productos = $GLOBALS['db']->query("SELECT * FROM Productos")->fetchAll();

        require __DIR__ . '/../views/ventas/crear.php';
    }

    public function crearPost()
    {
        Auth::requireLogin();

        if (!isset($_POST['items'])) {
            die("Error: no se enviaron productos en la venta");
        }

        $ventaModel = new Venta();
        $detalleModel = new VentaDetalle();

        $id_venta = $ventaModel->create([
            'id_cliente' => $_POST['id_cliente'],
            'tipo_documento' => $_POST['tipo_documento'],
            'numero_documento' => $_POST['numero_documento'],
            'monto_total' => $_POST['monto_total']
        ]);

        foreach ($_POST['items'] as $item) {
            $detalleModel->insertDetalle($id_venta, $item);
        }

        Helpers::redirect('ventas/ver?id=' . $id_venta);
    }

    public function ver()
    {
        Auth::requireLogin();

        $id = $_GET['id'];

        $venta = $GLOBALS['db']->query("
            SELECT v.*, CONCAT(c.nombres,' ',c.apellidos) AS cliente
            FROM Ventas v
            INNER JOIN Clientes c ON c.id_cliente = v.id_cliente
            WHERE id_venta = $id
        ")->fetch();

        $detalleModel = new VentaDetalle();
        $detalles = $detalleModel->getByVenta($id);

        require __DIR__ . '/../views/ventas/ver.php';
    }
}