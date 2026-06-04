<?php

class Helpers
{
    public static function baseUrl(): string
    {
        $config = require __DIR__ . '/../../config/app.php';
        return rtrim($config['base_url'], '/') . '/';
    }


    public static function asset(string $path): string
    {
        return self::baseUrl() . ltrim($path, '/');
    }

    public static function redirect(string $route): void
    {
        header("Location: " . self::baseUrl() . ltrim($route, '/'));
        exit;
    }
    public static function isPost(): bool
    {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

}