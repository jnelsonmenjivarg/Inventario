<?php

class Usuario {

    private $db;

 public function __construct()
{
    echo "<h3>Usuario.php constructor ejecutado</h3>";

    if (!isset($GLOBALS['db'])) {
        echo "<p style='color:red'>❌ \$GLOBALS['db'] NO existe</p>";
        die();
    }

    if (!($GLOBALS['db'] instanceof PDO)) {
        echo "<p style='color:red'>❌ \$GLOBALS['db'] NO ES PDO</p>";
        var_dump($GLOBALS['db']);
        die();
    }

    echo "<p style='color:green'>✔ \$GLOBALS['db'] ES un PDO válido</p>";

    $this->db = $GLOBALS['db'];
}



    public function findByEmail(string $email): ?array
    {
        $sql = "
            SELECT 
                u.id_usuario,
                u.nombre,
                u.email,
                u.password,
                ur.id_rol
            FROM usuarios u
            LEFT JOIN usuario_roles ur 
                ON ur.id_usuario = u.id_usuario
            WHERE u.email = :email
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }
}