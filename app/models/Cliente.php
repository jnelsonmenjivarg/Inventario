<?php

class Cliente
{
    private $db;

    public function __construct()
    {
        $this->db = $GLOBALS['db'];
    }

    public function all()
    {
        return $this->db->query("SELECT * FROM Clientes")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM Clientes WHERE id_cliente = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO Clientes 
                (nombres, apellidos, pais_origen, fecha_nacimiento, email, id_tributario)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['nombres'],
            $data['apellidos'],
            $data['pais_origen'],
            $data['fecha_nacimiento'],
            $data['email'],
            $data['id_tributario']
        ]);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE Clientes SET
                nombres = ?, apellidos = ?, pais_origen = ?, fecha_nacimiento = ?,
                email = ?, id_tributario = ?
                WHERE id_cliente = ?";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $data['nombres'],
            $data['apellidos'],
            $data['pais_origen'],
            $data['fecha_nacimiento'],
            $data['email'],
            $data['id_tributario'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM Clientes WHERE id_cliente = ?");
        return $stmt->execute([$id]);
    }
}
