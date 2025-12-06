<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<div class="dashboard-container">

    <h2>Bienvenido, <?= htmlspecialchars($usuario['nombre']) ?> 👋</h2>
    <p><strong>Rol:</strong> Cajero</p>

    <div class="cards">
        <div class="card">
            <h3>Ventas del día</h3>
            <p>$<?= number_format($stats['ventas_hoy'], 2) ?></p>
        </div>

        <div class="card">
            <h3>Total Productos</h3>
            <p><?= $stats['productos'] ?></p>
        </div>
    </div>

    <a class="btn" href="/ventas">Realizar Venta</a>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
