<?php
require_once __DIR__ . '/../models/Ubicacion.php';

class UbicacionController {
    public function index() {
        $modelo = new Ubicacion();
        $departamentos = $modelo->listarDepartamentos();
        $titulo = "Zonas Geográficas El Salvador";
        require_once __DIR__ . '/../views/ubicaciones/index.php';
    }

    // Estos métodos devuelven solo JSON para el JavaScript
    public function getMunicipios() {
        $modelo = new Ubicacion();
        echo json_encode($modelo->listarMunicipiosPorDepto($_GET['id']));
    }

    public function getDistritos() {
        $modelo = new Ubicacion();
        echo json_encode($modelo->listarDistritosPorMuni($_GET['id']));
    }
    // Método para guardar o editar Departamento
public function guardarDepto() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $db = $GLOBALS['db'];
        $descripcion = $_POST['descripcion'];
        $id = $_POST['id'] ?? null;

        if (empty($id)) {
            $stmt = $db->prepare("INSERT INTO departamentos (descripcion) VALUES (?)");
            $stmt->execute([$descripcion]);
        } else {
            $stmt = $db->prepare("UPDATE departamentos SET descripcion = ? WHERE id_departamento = ?");
            $stmt->execute([$descripcion, $id]);
        }
        header("Location: /ubicaciones");
    }
}

public function guardarMuni() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $db = $GLOBALS['db'];
        $descripcion = $_POST['descripcion']; 
        $id_depto = $_POST['id_departamento']; 
        // INSERT REAL EN LA BASE DE DATOS
        $stmt = $db->prepare("INSERT INTO municipios (descripcion, id_departamento) VALUES (?, ?)");
        $stmt->execute([$descripcion, $id_depto]);
        
        // Redirecciona manteniendo el depto seleccionado
        header("Location: /ubicaciones?id_depto=" . $id_depto);
        exit;
    }
}

public function guardarDist() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $db = $GLOBALS['db'];
        $descripcion = $_POST['descripcion'];
        $id_muni = $_POST['id_municipio'];
        $id_depto = $_POST['id_departamento_ref'];

        $stmt = $db->prepare("INSERT INTO distritos (descripcion, id_municipio) VALUES (?, ?)");
        $stmt->execute([$descripcion, $id_muni]);
        
        header("Location: /ubicaciones?id_depto=" . $id_depto . "&id_muni=" . $id_muni);
        exit;
    }
}

}