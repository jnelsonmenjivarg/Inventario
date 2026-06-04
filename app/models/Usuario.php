<?php
class Usuario {
    private $db;
    public function __construct() { 
        $this->db = $GLOBALS['db']; 
    }

    
    public function validarLogin($email, $password) {
        // CORRECCIÓN: Hacemos los JOINs necesarios para jalar el rol real desde la base de datos
        $sql = "SELECT u.*, r.descripcion as rol_nombre 
                FROM usuarios u
                INNER JOIN usuario_roles ur ON u.id_usuario = ur.id_usuario
                INNER JOIN roles r ON ur.id_rol = r.id_rol
                WHERE u.email = ? AND u.activo = 1";
                
        $stmt = $this->db->prepare($sql);
        $stmt->execute([trim($email)]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si no encuentra el usuario por email
        if (!$user) {
            return false; 
        }

        // Validación de contraseña
        if ($password === $user['password']) {
            // Eliminamos la línea fija que forzaba 'Administrador'
            // Ahora $user['rol_nombre'] traerá dinámicamente lo que devuelve el JOIN (ej: 'Cajero', 'admin', etc.)
            return $user;
        }
        
        return false;
    }


      public function listar() {
    $sql = "SELECT u.*, r.descripcion as rol_nombre 
            FROM usuarios u 
            INNER JOIN usuario_roles ur ON u.id_usuario = ur.id_usuario
            INNER JOIN roles r ON ur.id_rol = r.id_rol";
    return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

public function obtenerPermisos($id_usuario) {
        // 1. Seleccionamos únicamente la columna que SÍ existe en tu tabla opciones
        $sql = "SELECT o.descripcion 
                FROM opciones o
                INNER JOIN rol_opcion ro ON o.id_opcion = ro.id_opcion
                INNER JOIN usuario_roles ur ON ro.id_rol = ur.id_rol
                WHERE ur.id_usuario = ? AND o.b_activa = 1";
                
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_usuario]);
        // CORREGIDO: Eliminado el espacio en blanco accidental en el nombre de la variable
        $permisosRaw = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // 2. Mapeo dinámico: Le inyectamos la URL y el Icono en PHP según la descripción
        $permisosModificados = [];
        
        foreach ($permisosRaw as $opcion) {
            $descripcion = strtolower(trim($opcion['descripcion']));
            $url = '/inventario'; // Por defecto
            $icono = 'fas fa-folder'; // Por defecto

            // Definimos las reglas según los nombres de tus opciones en la base de datos
            if ($descripcion == 'usuarios') {
                $url = '/usuarios';
                $icono = 'fas fa-users';
            } elseif ($descripcion == 'roles') {
                $url = '/roles';
                $icono = 'fas fa-user-tag';
            } elseif ($descripcion == 'opciones') {
                $url = '/opciones';
                $icono = 'fas fa-list-ul';
            } elseif ($descripcion == 'permisos') {
                $url = '/permisos';
                $icono = 'fas fa-shield-alt';
            } elseif ($descripcion == 'proveedores') {
                $url = '/proveedores';
                $icono = 'fas fa-truck';
            } elseif ($descripcion == 'clientes') {
                $url = '/clientes';
                $icono = 'fas fa-user-friends';
            } elseif ($descripcion == 'ventas') {
                $url = '/ventas';
                $icono = 'fas fa-shopping-cart';
            } elseif ($descripcion == 'ubicaciones') {
                $url = '/ubicaciones';
                $icono = 'fas fa-map-marked-alt';
            } elseif ($descripcion == 'sucursales') {
                $url = '/sucursales';
                $icono = 'fas fa-store';
            } elseif ($descripcion == 'productos') {
                $url = '/productos';
                $icono = 'fas fa-boxes';
            }

            // Guardamos el registro con los campos simulados que espera tu sidebar.php
            $permisosModificados[] = [
                'descripcion' => $opcion['descripcion'],
                'url' => $url,
                'icono' => $icono
            ];
        }

        return $permisosModificados;
    }
public function buscarPorId($id) {
    $sql = "SELECT u.*, ur.id_rol 
            FROM usuarios u 
            LEFT JOIN usuario_roles ur ON u.id_usuario = ur.id_usuario 
            WHERE u.id_usuario = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function guardar($data) {
    try {
        // Iniciamos una transacción porque afectaremos dos tablas (usuarios y usuario_roles)
        $this->db->beginTransaction();

        if (empty($data['id_usuario'])) {
            // ----- MODO: INSERTAR NUEVO USUARIO -----
            $sql = "INSERT INTO usuarios (nombre, email, password, activo) VALUES (?, ?, ?, 1)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                trim($data['nombre']),
                trim($data['email']),
                $data['password'] // Mantenemos tu estándar de texto plano temporalmente
            ]);

            // Recuperamos el ID que la base de datos le asignó al usuario recién creado
            $id_usuario = $this->db->lastInsertId();

            // Insertamos la relación del Rol en la tabla intermedia
            $sqlRol = "INSERT INTO usuario_roles (id_usuario, id_rol) VALUES (?, ?)";
            $stmtRol = $this->db->prepare($sqlRol);
            $stmtRol->execute([$id_usuario, $data['id_rol']]);

        } else {
            // ----- MODO: ACTUALIZAR EXISTENTE -----
            $id_usuario = $data['id_usuario'];
            
            $sql = "UPDATE usuarios SET nombre = ?, email = ?, password = ? WHERE id_usuario = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                trim($data['nombre']),
                trim($data['email']),
                $data['password'],
                $id_usuario
            ]);

            $sqlRol = "UPDATE usuario_roles SET id_rol = ? WHERE id_usuario = ?";
            $stmtRol = $this->db->prepare($sqlRol);
            $stmtRol->execute([$data['id_rol'], $id_usuario]);
        }

                return true;

    } catch (Exception $e) {
        
        $this->db->rollBack();
       
        return false;
    }
}
public function cambiarEstado($id, $estado) {
    $sql = "UPDATE usuarios SET activo = ? WHERE id_usuario = ?";
    return $this->db->prepare($sql)->execute([$estado, $id]);
}

}