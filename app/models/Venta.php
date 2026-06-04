<?php

class Venta {
    private $db;

    public function __construct() {
        $this->db = $GLOBALS['db'];
    }

    public function guardar($data) {
        try {
            $this->db->beginTransaction();

            $sqlVenta = "INSERT INTO ventas (id_cliente, fecha_venta, monto_total, id_usuario, id_sucursal) VALUES (?, NOW(), ?, ?, ?)";
            $stmtVenta = $this->db->prepare($sqlVenta);
            
            $stmtVenta->execute([
                $data['id_cliente'], 
                $data['total'], 
                1, 
                $data['id_sucursal']
            ]);
            
            $idVenta = $this->db->lastInsertId();

            $sqlDetalle = "INSERT INTO venta_detalle (id_venta, id_producto, cantidad, precio_unitario) VALUES (?, ?, ?, ?)";
            $sqlStock = "UPDATE productos SET cantidad_actual = cantidad_actual - ? WHERE id_producto = ?";
            
            $stmtDetalle = $this->db->prepare($sqlDetalle);
            $stmtStock = $this->db->prepare($sqlStock);

            foreach ($data['productos'] as $prod) {
                $stmtDetalle->execute([$idVenta, $prod['id'], $prod['cantidad'], $prod['precio']]);
                $stmtStock->execute([$prod['cantidad'], $prod['id']]);
            }

            $this->db->commit();
            return $idVenta;
        } catch (Exception $e) {
            $this->db->rollBack();
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            exit;
        }
    }

       public function obtenerVentaPorId($id) {
        $sql = "SELECT v.*, 
                       CONCAT(c.nombres, ' ', c.apellidos) as cliente_nombre, 
                       s.nombre as sucursal_nombre 
                FROM ventas v
                INNER JOIN clientes c ON v.id_cliente = c.id_cliente
                INNER JOIN sucursales s ON v.id_sucursal = s.id_sucursal
                WHERE v.id_venta = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerDetallePorId($id) {
        $sql = "SELECT vd.*, p.descripcion_corta as producto_nombre 
                FROM venta_detalle vd
                INNER JOIN productos p ON vd.id_producto = p.id_producto
                WHERE vd.id_venta = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}