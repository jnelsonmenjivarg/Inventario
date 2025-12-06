<?php

class Proveedor
{
    private $db;

    public function __construct()
    {
        // Usa el PDO global creado en index.php
        $this->db = $GLOBALS['db'];
    }

    public function all(): array
    {
        $sql = "SELECT * FROM Proveedores ORDER BY id_proveedor ASC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM Proveedores WHERE id_proveedor = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function create(array $data): bool
    {
        $sql = "INSERT INTO Proveedores
                (descripcion_corta, descripcion_larga, pais_origen, id_tributario,
                 representante_legal, correo_proveedor)
                VALUES (:dc, :dl, :pais, :nit, :rep, :correo)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':dc'    => $data['descripcion_corta'],
            ':dl'    => $data['descripcion_larga'] ?? null,
            ':pais'  => $data['pais_origen'] ?? null,
            ':nit'   => $data['id_tributario'],
            ':rep'   => $data['representante_legal'] ?? null,
            ':correo'=> $data['correo_proveedor'],
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE Proveedores SET
                    descripcion_corta   = :dc,
                    descripcion_larga   = :dl,
                    pais_origen         = :pais,
                    id_tributario       = :nit,
                    representante_legal = :rep,
                    correo_proveedor    = :correo
                WHERE id_proveedor = :id";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':dc'    => $data['descripcion_corta'],
            ':dl'    => $data['descripcion_larga'] ?? null,
            ':pais'  => $data['pais_origen'] ?? null,
            ':nit'   => $data['id_tributario'],
            ':rep'   => $data['representante_legal'] ?? null,
            ':correo'=> $data['correo_proveedor'],
            ':id'    => $id,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM Proveedores WHERE id_proveedor = :id");
        return $stmt->execute([':id' => $id]);
    }
}
