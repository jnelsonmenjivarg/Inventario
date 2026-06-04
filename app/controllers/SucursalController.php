<?php
require_once __DIR__ . '/../models/Sucursal.php';

class SucursalController {
    public function index() {
        $modelo = new Sucursal();
        $sucursales = $modelo->listar();
        $titulo = "Mantenimiento de Sucursales";
        require_once __DIR__ . '/../views/sucursales/index.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $db = $GLOBALS['db'];
            $nombre = $_POST['nombre'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $id = $_POST['id_sucursal'] ?? null;

            if (empty($id)) {
                $stmt = $db->prepare("INSERT INTO sucursales (nombre, direccion, telefono) VALUES (?, ?, ?)");
                $stmt->execute([$nombre, $direccion, $telefono]);
            } else {
                $stmt = $db->prepare("UPDATE sucursales SET nombre = ?, direccion = ?, telefono = ? WHERE id_sucursal = ?");
                $stmt->execute([$nombre, $direccion, $telefono, $id]);
            }
            header("Location: /sucursales");
        }
    }

    public function eliminar() {
        $db = $GLOBALS['db'];
        $stmt = $db->prepare("DELETE FROM sucursales WHERE id_sucursal = ?");
        $stmt->execute([$_GET['id']]);
        header("Location: /sucursales");
    }
}