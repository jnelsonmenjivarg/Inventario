<?php

class RolOpcion {
    private $db;

    public function __construct() {
        $this->db = $GLOBALS['db'];
    }

    // Obtener qué opciones tiene un rol específico
    public function obtenerPermisosPorRol($id_rol) {
        $sql = "SELECT id_opcion FROM rol_opcion WHERE id_rol = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_rol]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    // Guardar los nuevos permisos
 public function guardarPermisos($id_rol, $opciones) {
    try {
        $this->db->beginTransaction();

        $sqlDelete = "DELETE FROM rol_opcion WHERE id_rol = ?";
        $this->db->prepare($sqlDelete)->execute([$id_rol]);

        if (!empty($opciones)) {
            // AJUSTE: Solo id_rol e id_opcion según tu MySQL Workbench
            $sqlInsert = "INSERT INTO rol_opcion (id_rol, id_opcion) VALUES (?, ?)";
            $stmt = $this->db->prepare($sqlInsert);
            
            foreach ($opciones as $id_opcion) {
                // Ejecutamos la inserción para cada ID recibido
                $stmt->execute([$id_rol, $id_opcion]);
            }
        }

        $this->db->commit();
        return true;
    } catch (Exception $e) {
        $this->db->rollBack();
        // Imprime el error real de la base de datos si algo falla
        die("Error en la base de datos: " . $e->getMessage());
        return false;
    }
}
}