<?php

class ProductosController extends Controller
{
    private $producto;

    public function __construct()
    {
        Auth::requireLogin();
        $this->producto = new Producto();
    }

    public function index()
    {
        $productos = $this->producto->all();
        $this->view("productos/index", compact("productos"));
    }

    public function crear()
    {
        $proveedores = $GLOBALS['db']->query("SELECT * FROM Proveedores")->fetchAll(PDO::FETCH_ASSOC);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $errores = [];

            if (empty($_POST['descripcion_corta'])) {
                $errores[] = "La descripción corta es obligatoria.";
            }
            if (empty($_POST['precio_unitario']) || !is_numeric($_POST['precio_unitario'])) {
                $errores[] = "El precio unitario debe ser numérico.";
            }

            if (!empty($errores)) {
                return $this->view("productos/crear", [
                    "errores" => $errores,
                    "old" => $_POST,
                    "proveedores" => $proveedores
                ]);
            }

            $this->producto->create($_POST);
            return redirect("/productos");
        }

        $this->view("productos/crear", [
            "proveedores" => $proveedores,
            "errores" => [],
            "old" => []
        ]);
    }

    public function editar($id)
    {
        $producto = $this->producto->find($id);
        $proveedores = $GLOBALS['db']->query("SELECT * FROM Proveedores")->fetchAll(PDO::FETCH_ASSOC);

        if (!$producto) {
            return redirect("/productos");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $errores = [];

            if (empty($_POST['descripcion_corta'])) {
                $errores[] = "La descripción corta es obligatoria.";
            }

            if (!empty($errores)) {
                return $this->view("productos/editar", [
                    "errores" => $errores,
                    "producto" => $producto,
                    "proveedores" => $proveedores
                ]);
            }

            $this->producto->update($id, $_POST);
            return redirect("/productos");
        }

        $this->view("productos/editar", [
            "producto" => $producto,
            "proveedores" => $proveedores,
            "errores" => []
        ]);
    }

    public function eliminar($id)
    {
        $this->producto->delete($id);
        return redirect("/productos");
    }
}
