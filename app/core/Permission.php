<?php

require_once __DIR__ . '/Helpers.php';

class Permission
{
    /**
     * Verifica que el usuario tenga uno de los roles indicados.
     */
    public static function requireRole(array $roles)
    {
        if (!isset($_SESSION['usuario'])) {
            Helpers::redirect('login');
        }

        $rolUsuario = $_SESSION['usuario']['id_rol'] ?? null;

        if (!in_array($rolUsuario, $roles)) {
            die('<h1>Acceso denegado</h1><p>No tiene permisos para ver esta página.</p>');
        }
    }
}
