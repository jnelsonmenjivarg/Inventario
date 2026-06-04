<?php

class Opcion {
    private $db;

    public function __construct() {
        $this->db = $GLOBALS['db'];
    }

    public function listar() {
        $sql = "SELECT * FROM opciones ORDER BY id_opcion ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function guardar($data) {
        if (empty($data['id'])) {
            // Nueva Opción
            $sql = "INSERT INTO opciones (descripcion, b_activa) VALUES (?, 1)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$data['descripcion']]);
        } else {
            // Editar Opción
            $sql = "UPDATE opciones SET descripcion = ? WHERE id_opcion = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$data['descripcion'], $data['id']]);
        }
    }

    public function cambiarEstado($id, $estado) {
        $sql = "UPDATE opciones SET b_activa = ? WHERE id_opcion = ?";
        return $this->db->prepare($sql)->execute([$estado, $id]);
    }
}