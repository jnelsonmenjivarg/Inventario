<?php

class Inventario
{
    private $db;

    public function __construct()
    {
        $this->db = $GLOBALS['db'];
    }

    public function all()
    {
        $sql = "SELECT i.*, p.descripcion_corta AS producto
                FROM Inventario i
                INNER JOIN Productos p ON p.id_producto = i.id_producto
                ORDER BY i.id_producto ASC";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id_producto, $id_sucursal)
    {
        $sql = "SELECT * FROM Inventario 
                WHERE id_producto = ? AND id_sucursal = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_producto, $id_sucursal]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO Inventario
                (id_producto, id_sucursal, cantidad_actual, cantidad_minima_alerta,
                 id_departamento, id_municipio, id_distrito)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $data['id_producto'],
            $data['id_sucursal'],
            $data['cantidad_actual'],
            $data['cantidad_minima_alerta'],
            $data['id_departamento'],
            $data['id_municipio'],
            $data['id_distrito']
        ]);
    }

    public function update($id_producto, $id_sucursal, $data)
    {
        $sql = "UPDATE Inventario SET
                cantidad_actual = ?, cantidad_minima_alerta = ?,
                id_departamento = ?, id_municipio = ?, id_distrito = ?
                WHERE id_producto = ? AND id_sucursal = ?";

        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            $data['cantidad_actual'],
            $data['cantidad_minima_alerta'],
            $data['id_departamento'],
            $data['id_municipio'],
            $data['id_distrito'],
            $id_producto,
            $id_sucursal
        ]);
    }

    public function delete($id_producto, $id_sucursal)
    {
        $stmt = $this->db->prepare(
            "DELETE FROM Inventario WHERE id_producto = ? AND id_sucursal = ?"
        );

        return $stmt->execute([$id_producto, $id_sucursal]);
    }
}
