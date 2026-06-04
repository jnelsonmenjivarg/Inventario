<?php

class Cliente {
    private $db;

    public function __construct() {
        $this->db = $GLOBALS['db'];
    }

    public function listar() {
        $sql = "SELECT * FROM clientes ORDER BY id_cliente DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function guardar($data) {
        try {
            if (empty($data['id'])) {
                $sql = "INSERT INTO clientes (nombres, apellidos, pais_origen, fecha_nacimiento, email, id_tributario) 
                        VALUES (?, ?, ?, ?, ?, ?)";
                $params = [
                    $data['nombres'], $data['apellidos'], $data['pais_origen'],
                    $data['fecha_nacimiento'], $data['email'], $data['id_tributario']
                ];
            } else {
                $sql = "UPDATE clientes SET nombres = ?, apellidos = ?, pais_origen = ?, 
                        fecha_nacimiento = ?, email = ?, id_tributario = ? WHERE id_cliente = ?";
                $params = [
                    $data['nombres'], $data['apellidos'], $data['pais_origen'],
                    $data['fecha_nacimiento'], $data['email'], $data['id_tributario'], $data['id']
                ];
            }
            return $this->db->prepare($sql)->execute($params);

        } catch (PDOException $e) {
            if ($e->getCode() == '23000') {
                echo "<script>alert('❌ Error: El correo o ID tributario ya existe.'); window.history.back();</script>";
                exit;
            }
            die("Error: " . $e->getMessage());
        }
    }

    public function eliminar($id) {
        $sql = "DELETE FROM clientes WHERE id_cliente = ?";
        return $this->db->prepare($sql)->execute([$id]);
    }
}