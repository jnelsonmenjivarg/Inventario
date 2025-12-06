<?php

class Database
{
    private static $host = "localhost";
    private static $user = "root";
    private static $pass = "";
    private static $db   = "Inventario";

    public static function getConnection()
    {
        $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=utf8mb4";

        try {

            return new PDO($dsn, self::$user, self::$pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);

        } catch (PDOException $e) {
            die("❌ Error de conexión: " . $e->getMessage());
        }
    }
}
