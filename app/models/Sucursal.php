<?php
class Sucursal {
    private $db;
    public function __construct() { $this->db = $GLOBALS['db']; }

    public function listar() {
        return $this->db->query("SELECT * FROM sucursales ORDER BY nombre ASC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM sucursales WHERE id_sucursal = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}