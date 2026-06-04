<?php

require_once __DIR__ . '/../core/Auth.php';

class ClientesController
{
    private $cliente;

    public function __construct()
    {
        Auth::requireLogin();
        $this->cliente = new Cliente();
    }

    public function index()
    {
        $clientes = $this->cliente->all();
        require __DIR__ . '/../views/clientes/index.php';
    }

    public function crear()
    {
        if (Helpers::isPost()) {

            $data = [
                'nombres'         => Helpers::sanitize($_POST['nombres']),
                'apellidos'       => Helpers::sanitize($_POST['apellidos']),
                'pais_origen'     => Helpers::sanitize($_POST['pais_origen']),
                'fecha_nacimiento'=> $_POST['fecha_nacimiento'],
                'email'           => Helpers::sanitize($_POST['email']),
                'id_tributario'   => Helpers::sanitize($_POST['id_tributario']),
            ];

            $this->cliente->create($data);
            Helpers::redirect('clientes');
        }

        require __DIR__ . '/../views/clientes/crear.php';
    }

    public function editar()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) Helpers::redirect('clientes');

        if (Helpers::isPost()) {

            $data = [
                'nombres'         => Helpers::sanitize($_POST['nombres']),
                'apellidos'       => Helpers::sanitize($_POST['apellidos']),
                'pais_origen'     => Helpers::sanitize($_POST['pais_origen']),
                'fecha_nacimiento'=> $_POST['fecha_nacimiento'],
                'email'           => Helpers::sanitize($_POST['email']),
                'id_tributario'   => Helpers::sanitize($_POST['id_tributario']),
            ];

            $this->cliente->update($id, $data);
            Helpers::redirect('clientes');
        }

        $cliente = $this->cliente->find($id);
        require __DIR__ . '/../views/clientes/editar.php';
    }

    public function eliminar()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->cliente->delete($id);
        }
        Helpers::redirect('clientes');
    }
}
