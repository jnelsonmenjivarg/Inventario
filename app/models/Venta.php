<?php

class Venta
{
    private $db;

    public function __construct()
    {
        $this->db = $GLOBALS['db'];
    }

    public function all()
    {
        $sql = "
            SELECT v.*, CONCAT(c.nombres,' ',c.apellidos) AS cliente 
            FROM Ventas v
            INNER JOIN Clientes c ON c.id_cliente = v.id_cliente
            ORDER BY v.id_venta DESC
        ";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO Ventas (id_cliente, tipo_documento, numero_documento, monto_total)
                VALUES (?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['id_cliente'],
            $data['tipo_documento'],
            $data['numero_documento'],
            $data['monto_total']
        ]);

        return $this->db->lastInsertId();
    }
}