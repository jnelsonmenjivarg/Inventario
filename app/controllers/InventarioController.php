<?php

require_once __DIR__ . '/../core/Auth.php';

class InventarioController
{
    private $inv;
    private $prod;

    public function __construct()
    {
        Auth::requireLogin();
        $this->inv  = new Inventario();
        $this->prod = new Producto();
    }

    public function index()
    {
        Permission::requireRole([1, 3]); // Admin y Bodega
        $inventario = $this->inv->all();
        require __DIR__ . '/../views/inventario/index.php';
    }

    public function crear()
    {
        $productos = $this->prod->all();

        if (Helpers::isPost()) {

            $data = [
                'id_producto'            => $_POST['id_producto'],
                'id_sucursal'            => $_POST['id_sucursal'],
                'cantidad_actual'        => $_POST['cantidad_actual'],
                'cantidad_minima_alerta'=> $_POST['cantidad_minima_alerta'],
                'id_departamento'        => $_POST['id_departamento'],
                'id_municipio'           => $_POST['id_municipio'],
                'id_distrito'            => $_POST['id_distrito']
            ];

            $this->inv->create($data);
            Helpers::redirect('inventario');
        }

        require __DIR__ . '/../views/inventario/crear.php';
    }

    public function editar()
    {
        $id_producto  = $_GET['id_producto'] ?? null;
        $id_sucursal  = $_GET['id_sucursal'] ?? null;

        if (!$id_producto || !$id_sucursal) {
            Helpers::redirect('inventario');
        }

        $item       = $this->inv->find($id_producto, $id_sucursal);
        $productos  = $this->prod->all();

        if (Helpers::isPost()) {

            $data = [
                'cantidad_actual'        => $_POST['cantidad_actual'],
                'cantidad_minima_alerta'=> $_POST['cantidad_minima_alerta'],
                'id_departamento'        => $_POST['id_departamento'],
                'id_municipio'           => $_POST['id_municipio'],
                'id_distrito'            => $_POST['id_distrito']
            ];

            $this->inv->update($id_producto, $id_sucursal, $data);
            Helpers::redirect('inventario');
        }

        require __DIR__ . '/../views/inventario/editar.php';
    }

    public function eliminar()
    {
        $id_producto = $_GET['id_producto'] ?? null;
        $id_sucursal = $_GET['id_sucursal'] ?? null;

        if ($id_producto && $id_sucursal) {
            $this->inv->delete($id_producto, $id_sucursal);
        }

        Helpers::redirect('inventario');
    }
}