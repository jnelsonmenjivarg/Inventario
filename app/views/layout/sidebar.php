<?php 
$rol = $_SESSION['usuario']['id_rol'] ?? null;
?>

<aside class="sidebar">

    <div class="sidebar-title">
        <h2>Inventario</h2>
        <small>El Baratillo</small>
    </div>

    <ul class="menu">

        <!-- Acceso para TODOS los roles -->
        <li><a href="<?= Helpers::baseUrl(); ?>dashboard">🏠 Dashboard</a></li>

        <?php if ($rol == 1): // ADMIN ?>
            <li><a href="<?= Helpers::baseUrl(); ?>usuarios">👤 Usuarios</a></li>
            <li><a href="<?= Helpers::baseUrl(); ?>roles">🛡 Roles</a></li>
            <li><a href="<?= Helpers::baseUrl(); ?>proveedores">🏢 Proveedores</a></li>
            <li><a href="<?= Helpers::baseUrl(); ?>productos">📦 Productos</a></li>
            <li><a href="<?= Helpers::baseUrl(); ?>clientes">👥 Clientes</a></li>
            <li><a href="<?= Helpers::baseUrl(); ?>inventario">📊 Inventario</a></li>
            <li><a href="<?= Helpers::baseUrl(); ?>ventas">🧾 Ventas</a></li>

            <li><a href="<?= Helpers::baseUrl(); ?>reportes/compras">📄 Reporte de Compras</a></li>
            <li><a href="<?= Helpers::baseUrl(); ?>reportes/existencias">📦 Existencias</a></li>
            <li><a href="<?= Helpers::baseUrl(); ?>reportes/ventas">💵 Ventas</a></li>
            <li><a href="<?= Helpers::baseUrl(); ?>reportes/stock">📦 Productos en Stock</a></li>
            <li><a href="<?= Helpers::baseUrl(); ?>reportes/mensual">📊 Ventas vs Compras mensual</a></li>

        <?php elseif ($rol == 2): // CAJERO ?>
            <li><a href="<?= Helpers::baseUrl(); ?>ventas">🧾 Ventas</a></li>
            <li><a href="<?= Helpers::baseUrl(); ?>clientes">👥 Clientes</a></li>
            <li><a href="<?= Helpers::baseUrl(); ?>productos">📦 Productos</a></li>

        <?php elseif ($rol == 3): // BODEGA ?>
            <li><a href="<?= Helpers::baseUrl(); ?>inventario">📊 Inventario</a></li>
            <li><a href="<?= Helpers::baseUrl(); ?>productos">📦 Productos</a></li>
            <li><a href="<?= Helpers::baseUrl(); ?>proveedores">🏢 Proveedores</a></li>
        <?php endif; ?>

        <li><a href="<?= Helpers::baseUrl(); ?>logout" class="logout">🚪 Cerrar sesión</a></li>
    </ul>
</aside>
