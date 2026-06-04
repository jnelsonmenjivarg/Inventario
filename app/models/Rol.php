<?php

class Rol {
    private $db;

    public function __construct() {
        $this->db = $GLOBALS['db'];
    }

    public function listar() {
        $sql = "SELECT * FROM roles";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function guardar($data) {
        if (empty($data['id'])) {
            $sql = "INSERT INTO roles (descripcion) VALUES (?)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$data['descripcion']]);
        } else {
            $sql = "UPDATE roles SET descripcion = ? WHERE id_rol = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$data['descripcion'], $data['id']]);
        }
    }

    public function borrar($id) {
        // Nota: En un sistema real, antes de borrar un rol deberías verificar 
        // que no existan usuarios asignados a él.
        $sql = "DELETE FROM roles WHERE id_rol = ?";
        return $this->db->prepare($sql)->execute([$id]);
    }
}