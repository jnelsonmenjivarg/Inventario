<?php

class Inventario {
    private $db;

    public function __construct() {
        $this->db = $GLOBALS['db'];
    }

    public function listar() {
    $sql = "SELECT p.*, pr.descripcion_corta as proveedor 
            FROM productos p 
            INNER JOIN proveedores pr ON p.id_proveedor = pr.id_proveedor"; 
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function crear($data) {
        $sql = "INSERT INTO productos 
                (descripcion_corta, descripcion_larga, presentacion, pais_origen, 
                 cantidad_maxima, cantidad_actual, precio_unitario, precio_venta, 
                 codigo_barras, id_proveedor) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['descripcion_corta'],
            $data['descripcion_larga'],
            $data['presentacion'],
            $data['pais_origen'],
            $data['cantidad_maxima'],
            $data['cantidad_actual'],
            $data['precio_unitario'],
            $data['precio_venta'],
            $data['codigo_barras'],
            $data['id_proveedor'] 
        ]);
    }

    public function actualizar($data) {
    $sql = "UPDATE productos SET 
            descripcion_corta = ?, descripcion_larga = ?, presentacion = ?, 
            pais_origen = ?, cantidad_maxima = ?, cantidad_actual = ?, 
            precio_unitario = ?, precio_venta = ?, codigo_barras = ?, 
            id_proveedor = ? 
            WHERE id_producto = ?";
    
    $stmt = $this->db->prepare($sql);

    return $stmt->execute([
        $data['descripcion_corta'],
        $data['descripcion_larga'],
        $data['presentacion'],
        $data['pais_origen'],
        $data['cantidad_maxima'],
        $data['cantidad_actual'],
        $data['precio_unitario'],
        $data['precio_venta'],
        $data['codigo_barras'],
        $data['id_proveedor'],
        $data['id'] 
    ]);
}

    public function borrar($id) {
        $sql = "DELETE FROM productos WHERE id_producto = ?";
        return $this->db->prepare($sql)->execute([$id]);
    }
}