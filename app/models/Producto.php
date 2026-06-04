<?php
class Producto {
    private $db;
    public function __construct() { $this->db = $GLOBALS['db']; }

    public function listar() {
        $sql = "SELECT p.*, prov.descripcion_corta as proveedor 
                FROM productos p 
                LEFT JOIN proveedores prov ON p.id_proveedor = prov.id_proveedor 
                ORDER BY p.descripcion_corta ASC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function guardar($data) {
        $id = !empty($data['id_producto']) ? $data['id_producto'] : null;
        
        if ($id) {
            $sql = "UPDATE productos SET 
                    descripcion_corta = ?, descripcion_larga = ?, precio_unitario = ?, 
                    precio_venta = ?, cantidad_actual = ?, cantidad_maxima = ?, 
                    id_proveedor = ?, id_sucursal = ?, codigo_barras = ?, 
                    numero_lote = ?, f_vencimiento = ? 
                    WHERE id_producto = ?";
            $params = [
                $data['nombre'], $data['detalle'], $data['costo'], $data['venta'], 
                $data['stock'], $data['stock_max'], $data['id_prov'], $data['id_suc'], 
                $data['codigo'], $data['lote'], $data['fecha_vence'], $id
            ];
        } else {
            // LÓGICA DE INSERCIÓN
            $sql = "INSERT INTO productos (descripcion_corta, descripcion_larga, precio_unitario, precio_venta, 
                    cantidad_actual, cantidad_maxima, id_proveedor, id_sucursal, codigo_barras, numero_lote, f_vencimiento) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $params = [
                $data['nombre'], $data['detalle'], $data['costo'], $data['venta'], 
                $data['stock'], $data['stock_max'], $data['id_prov'], $data['id_suc'], 
                $data['codigo'], $data['lote'], $data['fecha_vence']
            ];
        }
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }
}