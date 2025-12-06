<?php

class Helpers
{
    public static function baseUrl(): string
    {
        $config = require __DIR__ . '/../../config/app.php';
        return rtrim($config['base_url'], '/') . '/';
    }

    /**
     * Genera la URL completa a un asset (CSS, JS, imágenes)
     * Ej: Helpers::asset('css/styles.css') => http://localhost:8080/css/styles.css
     */
    public static function asset(string $path): string
    {
        return self::baseUrl() . ltrim($path, '/');
    }

    public static function redirect(string $route): void
    {
        header("Location: " . self::baseUrl() . ltrim($route, '/'));
        exit;
    }
}
