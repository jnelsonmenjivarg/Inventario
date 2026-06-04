<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$current_url = $_SERVER['REQUEST_URI'];

if (!isset($_SESSION['id_usuario']) && strpos($current_url, 'login') === false) {
    header("Location: /login");
    exit;
}

if (isset($_SESSION['id_usuario']) && strpos($current_url, 'login') !== false) {
    header("Location: /productos");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>INVENTARIO G1</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/css/styles.css?v=<?= time(); ?>">
</head>

<body>

    </head>

    <body>
        <?php if (isset($_SESSION['id_usuario'])) include_once 'sidebar.php'; ?>

        <div class="main-content">