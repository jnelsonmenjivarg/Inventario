<?php

class Producto
{
    private $db;

    public function __construct()
    {
        $this->db = $GLOBALS['db'];
    }

    public function all()
    {
        $sql = "SELECT p.*, pr.descripcion_corta AS proveedor
                FROM Productos p
                INNER JOIN Proveedores pr ON pr.id_proveedor = p.id_proveedor";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $sql = "SELECT * FROM Productos WHERE id_producto = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO Productos 
                (descripcion_corta, descripcion_larga, presentacion, pais_origen,
                 cantidad_maxima, cantidad_actual, precio_unitario, precio_venta, codigo_barras, id_proveedor)
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

    public function update($id, $data)
    {
        $sql = "UPDATE Productos SET
                descripcion_corta = ?, descripcion_larga = ?, presentacion = ?, pais_origen = ?,
                cantidad_maxima = ?, cantidad_actual = ?, precio_unitario = ?, precio_venta = ?, 
                codigo_barras = ?, id_proveedor = ?
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
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM Productos WHERE id_producto = ?");
        return $stmt->execute([$id]);
    }
}
