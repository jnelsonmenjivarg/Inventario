<?php
// core/Auth.php

class Auth
{

    public static function getRole()
    {
        return $_SESSION['usuario']['id_rol'] ?? null;
    }

    public static function check(): bool
    {
        return isset($_SESSION['usuario']);
    }

    public static function user(): ?array
    {
        return $_SESSION['usuario'] ?? null;
    }

    public static function attempt(string $email, string $password): bool {

    require_once __DIR__ . '/../models/Usuario.php';
    $usuarioModel = new Usuario();

    $user = $usuarioModel->findByEmail($email);
    if (!$user) {
        return false;
    }

    if (!password_verify($password, $user['password'])) {
        return false;
    }

    // Guardar en sesión
    $_SESSION['usuario'] = [
        'id_usuario' => $user['id_usuario'],
        'nombre'     => $user['nombre'],
        'email'      => $user['email'],
        'id_rol'     => $user['id_rol'],
    ];

    return true;
}



    public static function logout(): void
    {
        session_unset();
        session_destroy();
    }

    public static function requireLogin(): void
    {
        if (!self::check()) {
            header('Location: /login');
            exit;
        }
    }
}