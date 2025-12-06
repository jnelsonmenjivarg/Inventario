<?php

require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/Helpers.php';
require_once __DIR__ . '/../models/Proveedor.php';

class ProveedoresController
{
    private $proveedor;

    public function __construct()
    {
        Auth::requireLogin();
        $this->proveedor = new Proveedor();
    }

    public function index()
    {
        $proveedores = $this->proveedor->all();
        require __DIR__ . '/../views/proveedores/index.php';
    }

    public function crear()
    {
        if (Helpers::isPost()) {

            $data = [
                'descripcion_corta'   => Helpers::sanitize($_POST['descripcion_corta'] ?? ''),
                'descripcion_larga'   => Helpers::sanitize($_POST['descripcion_larga'] ?? ''),
                'pais_origen'         => Helpers::sanitize($_POST['pais_origen'] ?? ''),
                'id_tributario'       => Helpers::sanitize($_POST['id_tributario'] ?? ''),
                'representante_legal' => Helpers::sanitize($_POST['representante_legal'] ?? ''),
                'correo_proveedor'    => Helpers::sanitize($_POST['correo_proveedor'] ?? ''),
            ];

            $this->proveedor->create($data);
            Helpers::redirect('proveedores');
        }

        require __DIR__ . '/../views/proveedores/crear.php';
    }

    public function editar()
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $proveedor = $this->proveedor->find($id);

        if (!$proveedor) {
            Helpers::redirect('proveedores');
        }

        if (Helpers::isPost()) {
            $data = [
                'descripcion_corta'   => Helpers::sanitize($_POST['descripcion_corta'] ?? ''),
                'descripcion_larga'   => Helpers::sanitize($_POST['descripcion_larga'] ?? ''),
                'pais_origen'         => Helpers::sanitize($_POST['pais_origen'] ?? ''),
                'id_tributario'       => Helpers::sanitize($_POST['id_tributario'] ?? ''),
                'representante_legal' => Helpers::sanitize($_POST['representante_legal'] ?? ''),
                'correo_proveedor'    => Helpers::sanitize($_POST['correo_proveedor'] ?? ''),
            ];

            $this->proveedor->update($id, $data);
            Helpers::redirect('proveedores');
        }

        require __DIR__ . '/../views/proveedores/editar.php';
    }

    public function eliminar()
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        if ($id > 0) {
            $this->proveedor->delete($id);
        }
        Helpers::redirect('proveedores');
    }
}
