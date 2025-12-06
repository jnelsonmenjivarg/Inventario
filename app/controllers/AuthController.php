<?php

require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../core/Helpers.php';
require_once __DIR__ . '/../core/Auth.php';

class AuthController
{
    public function loginForm()
    {
        if (Auth::check()) {
            Helpers::redirect('/dashboard');
        }

        require __DIR__ . '/../views/auth/login.php';
    }


    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helpers::redirect('login');
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Comprobar credenciales mediante Auth::attempt()
        if (!Auth::attempt($email, $password)) {

            $error = "Credenciales inválidas.";
            require __DIR__ . '/../views/auth/login.php';
            return;
        }

        // Si llega aquí, login exitoso
        Helpers::redirect('/dashboard');
    }


    public function logout()
    {
        session_destroy();
        Helpers::redirect('login');
    }
}