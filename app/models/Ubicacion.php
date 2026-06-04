<?php
class Ubicacion {
    private $db;
    public function __construct() { $this->db = $GLOBALS['db']; }

    public function listarDepartamentos() {
        return $this->db->query("SELECT * FROM departamentos ORDER BY descripcion")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarMunicipiosPorDepto($id_depto) {
        $stmt = $this->db->prepare("SELECT * FROM municipios WHERE id_departamento = ? ORDER BY descripcion");
        $stmt->execute([$id_depto]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarDistritosPorMuni($id_muni) {
        $stmt = $this->db->prepare("SELECT * FROM distritos WHERE id_municipio = ? ORDER BY descripcion");
        $stmt->execute([$id_muni]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}