<?php

class Helpers
{
    public static function redirect($rutroutesa)
    {
        header("Location: /$routes");
        exit;
    }

    public static function asset($routes)
    {
        return "/public/" . ltrim($routes, "/");
    }

    public static function sanitize($texto)
    {
        return htmlspecialchars(trim($texto), ENT_QUOTES, 'UTF-8');
    }

    public static function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}