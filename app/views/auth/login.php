<?php
// Si existe sesión activa, redirigir
if (isset($_SESSION['usuario'])) {
    Helpers::redirect('dashboard');
}
?>

<!DOCTYPE html>
<html lang="es">


<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión - Bodegón El Baratillo</title>

    <style>
    body {
        font-family: Arial, sans-serif;
        background: #f0f2f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .login-container {
        width: 380px;
        background: #fff;
        padding: 35px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .input-group {
        margin-bottom: 18px;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: bold;
        color: #444;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 15px;
    }

    input:focus {
        border-color: #007bff;
        outline: none;
    }

    .btn-login {
        width: 100%;
        padding: 12px;
        background: #007bff;
        border: none;
        color: white;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 10px;
        transition: 0.3s;
    }

    .btn-login:hover {
        background: #0056b3;
    }

    .error-box {
        background: #ffdddd;
        padding: 12px;
        border-left: 4px solid red;
        margin-bottom: 18px;
        color: #a70000;
        border-radius: 6px;
        font-size: 14px;
    }
    </style>

    <script>
    function validarLogin() {
        const email = document.getElementById("email").value.trim();
        const pass = document.getElementById("password").value.trim();

        if (email === "" || pass === "") {
            alert("Todos los campos son obligatorios.");
            return false;
        }

        return true;
    }
    </script>

</head>

<body>

    <div class="login-container">

        <h2>Bodegón El Baratillo</h2>

        <?php if (!empty($error)): ?>
        <div class="error-box"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <!-- <form action="/login_post" method="POST" onsubmit="return validarLogin()"> -->

        <form action="<?= Helpers::baseUrl(); ?>login_post" method="POST" onsubmit="return validarLogin()"></form>

        <div class="input-group">
            <label for="email">Correo electrónico:</label>
            <input type="text" name="email" id="email" placeholder="ejemplo@correo.com">
        </div>

        <div class="input-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" placeholder="*******">
        </div>

        <button type="submit" class="btn-login">Ingresar</button>

        </form>

    </div>

</body>

</html>