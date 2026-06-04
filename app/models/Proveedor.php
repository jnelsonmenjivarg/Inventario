<?php

class Proveedor {
    private $db;

    public function __construct() {
        $this->db = $GLOBALS['db'];
    }

    public function listar() {
        $sql = "SELECT * FROM proveedores ORDER BY id_proveedor DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function guardar($data) {
        if (empty($data['id'])) {
            // NUEVO PROVEEDOR
            $sql = "INSERT INTO proveedores (descripcion_corta, descripcion_larga, pais_origen, id_tributario, representante_legal, correo_proveedor) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $params = [
                $data['descripcion_corta'], $data['descripcion_larga'], $data['pais_origen'],
                $data['id_tributario'], $data['representante_legal'], $data['correo_proveedor']
            ];
        } else {
            // EDITAR PROVEEDOR
            $sql = "UPDATE proveedores SET descripcion_corta = ?, descripcion_larga = ?, pais_origen = ?, 
                    id_tributario = ?, representante_legal = ?, correo_proveedor = ? WHERE id_proveedor = ?";
            $params = [
                $data['descripcion_corta'], $data['descripcion_larga'], $data['pais_origen'],
                $data['id_tributario'], $data['representante_legal'], $data['correo_proveedor'], $data['id']
            ];
        }
        return $this->db->prepare($sql)->execute($params);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM proveedores WHERE id_proveedor = ?";
        return $this->db->prepare($sql)->execute([$id]);
    }
}