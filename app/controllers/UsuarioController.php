    <?php
    require_once __DIR__ . '/../models/Usuario.php';

    class UsuarioController {
        public function index() {
            $modelo = new Usuario();
            $usuarios = $modelo->listar();
            
            // Obtenemos los roles para las vistas
            $roles = $GLOBALS['db']->query("SELECT * FROM roles")->fetchAll(PDO::FETCH_ASSOC);
            
            $titulo = "Gestión de Usuarios";
            require_once __DIR__ . '/../views/usuarios/index.php';
        }

        public function crear() {
            $roles = $GLOBALS['db']->query("SELECT * FROM roles")->fetchAll(PDO::FETCH_ASSOC);
            require_once __DIR__ . '/../views/usuarios/crear.php';
        }
        public function guardar() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $modelo = new Usuario();
                $modelo->guardar($_POST); 
                header("Location: /usuarios");
                exit;
            }
        }

        // NUEVO: Método para mostrar el formulario de edición
        public function editar() {
            $id = $_GET['id'] ?? null;
            if (!$id) { header("Location: /usuarios"); exit; }
            
            $modelo = new Usuario();
            $usuario = $modelo->buscarPorId($id); 
            $roles = $GLOBALS['db']->query("SELECT * FROM roles")->fetchAll(PDO::FETCH_ASSOC);
            
            require_once __DIR__ . '/../views/usuarios/editar.php';
        }

        public function eliminar() {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $modelo = new Usuario();
                $modelo->cambiarEstado($id, 0);
            }
            header("Location: /usuarios");
            exit;
        }
    }