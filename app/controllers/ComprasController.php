<?php

require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/Helpers.php';
require_once __DIR__ . '/../models/Compra.php';
require_once __DIR__ . '/../models/Proveedor.php';
require_once __DIR__ . '/../models/Producto.php';

class ComprasController
{
    private $compra;
    private $proveedor;
    private $producto;

    public function __construct()
    {
        Auth::requireLogin();
        $this->compra    = new Compra();
        $this->proveedor = new Proveedor();
        $this->producto  = new Producto();
    }

    public function index()
    {
        $compras = $this->compra->all();
        require __DIR__ . '/../views/compras/index.php';
    }

    public function crear()
    {
        $proveedores = $this->proveedor->all();
        $productos   = $this->producto->all();

        require __DIR__ . '/../views/compras/crear.php';
    }

    public function crearPost()
    {
        if (!Helpers::isPost()) {
            Helpers::redirect('compras');
        }

        $id_proveedor     = (int) ($_POST['id_proveedor'] ?? 0);
        $numero_documento = Helpers::sanitize($_POST['numero_documento'] ?? '');

        // Arrays de detalle
        $ids_prod = $_POST['id_producto'] ?? [];
        $cantidades = $_POST['cantidad'] ?? [];
        $precios    = $_POST['precio_unitario'] ?? [];

        $items = [];
        $monto_total = 0;

        for ($i = 0; $i < count($ids_prod); $i++) {
            if (empty($ids_prod[$i]) || empty($cantidades[$i]) || empty($precios[$i])) {
                continue;
            }

            $idp   = (int) $ids_prod[$i];
            $cant  = (int) $cantidades[$i];
            $precio= (float) $precios[$i];
            $sub   = $cant * $precio;

            $monto_total += $sub;

            $items[] = [
                'id_producto'    => $idp,
                'cantidad'       => $cant,
                'precio_unitario'=> $precio,
                'subtotal'       => $sub,
            ];
        }

        if ($id_proveedor <= 0 || $numero_documento === '' || empty($items)) {
            // Podrías agregar aquí un mensaje de error en sesión
            Helpers::redirect('compras/crear');
        }

        $data = [
            'id_proveedor'     => $id_proveedor,
            'numero_documento' => $numero_documento,
            'monto_total'      => $monto_total,
        ];

        $idCompra = $this->compra->create($data, $items);

        Helpers::redirect('compras/ver?id=' . $idCompra);
    }

    public function ver()
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $compra = $this->compra->find($id);
        if (!$compra) {
            Helpers::redirect('compras');
        }

        $detalles = $this->compra->detalles($id);

        require __DIR__ . '/../views/compras/ver.php';
    }
}
