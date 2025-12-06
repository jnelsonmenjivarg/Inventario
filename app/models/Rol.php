<?php

class Rol
{
    private $db;

    public function __construct()
    {
        $this->db = $GLOBALS['db'];
    }

    public function all()
    {
        return $this->db->query("SELECT * FROM roles ORDER BY id_rol ASC")
                        ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM roles WHERE id_rol = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($descripcion)
    {
        $stmt = $this->db->prepare("INSERT INTO roles (descripcion) VALUES (?)");
        return $stmt->execute([$descripcion]);
    }

    public function update($id, $descripcion)
    {
        $stmt = $this->db->prepare("UPDATE roles SET descripcion = ? WHERE id_rol = ?");
        return $stmt->execute([$descripcion, $id]);
    }

    public function delete($id)
    {
        // OJO: No eliminar roles usados por usuarios
        $check = $this->db->prepare("SELECT COUNT(*) FROM usuario_roles WHERE id_rol = ?");
        $check->execute([$id]);

        if ($check->fetchColumn() > 0) {
            die("<h2>No se puede eliminar este rol porque está asignado a usuarios.</h2>");
        }

        $stmt = $this->db->prepare("DELETE FROM roles WHERE id_rol = ?");
        return $stmt->execute([$id]);
    }
}
