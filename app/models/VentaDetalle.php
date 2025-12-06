<?php

class VentaDetalle
{
    private $db;

    public function __construct()
    {
        $this->db = $GLOBALS['db'];
    }

    public function insertDetalle($id_venta, $item)
    {
        $sql = "INSERT INTO Venta_Detalle 
                (id_venta, id_producto, cantidad, precio_unitario_venta, subtotal)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $id_venta,
            $item['id_producto'],
            $item['cantidad'],
            $item['precio_unitario'],
            $item['subtotal']
        ]);
    }

    public function getByVenta($id_venta)
    {
        $sql = "
            SELECT vd.*, p.descripcion_corta 
            FROM Venta_Detalle vd
            INNER JOIN Productos p ON p.id_producto = vd.id_producto
            WHERE vd.id_venta = ?
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_venta]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
