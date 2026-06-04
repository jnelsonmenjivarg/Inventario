<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<div class="dashboard-container">

    <h2>Bienvenido, <?= htmlspecialchars($usuario['nombre']) ?> 👋</h2>
    <p><strong>Rol:</strong> Bodega</p>

    <div class="cards">
        <div class="card">
            <h3>Total Productos</h3>
            <p><?= $stats['total_productos'] ?></p>
        </div>

        <div class="card">
            <h3>Stock Crítico</h3>
            <p><?= $stats['stock_bajo'] ?></p>
        </div>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>