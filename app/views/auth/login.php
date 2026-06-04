<!DOCTYPE html>
<html>
<head>
    <title>Login - Inventario G1</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background: #2c3e50; font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); width: 350px; }
        .login-box h2 { text-align: center; color: #2c3e50; }
        .form-group { margin-bottom: 20px; }
        .form-group input { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        .btn-login { width: 100%; padding: 12px; background: #27ae60; border: none; color: white; border-radius: 5px; cursor: pointer; font-size: 16px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2><i class="fas fa-boxes"></i> Inventario G1</h2>
        <form action="/login" method="POST">
            <div class="form-group">
                <input type="email" name="email" placeholder="Correo Electrónico" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Contraseña" required>
            </div>
            <?php if(isset($error)): ?>
                <p style="color:red; font-size:13px;"><?= $error ?></p>
            <?php endif; ?>
            <button type="submit" class="btn-login">Ingresar al Sistema</button>
        </form>
    </div>
</body>
</html>