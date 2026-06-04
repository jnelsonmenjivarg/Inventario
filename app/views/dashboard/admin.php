<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<div class="dashboard-container">

    <h2>Bienvenido, <?= htmlspecialchars($usuario['nombre']) ?> 👋</h2>
    <p><strong>Rol:</strong> Administrador</p>

    <div class="cards">
        <div class="card">
            <h3>Productos</h3>
            <p><?= $stats['total_productos'] ?></p>
        </div>

        <div class="card">
            <h3>Clientes</h3>
            <p><?= $stats['total_clientes'] ?></p>
        </div>

        <div class="card">
            <h3>Usuarios</h3>
            <p><?= $stats['total_usuarios'] ?></p>
        </div>

        <div class="card">
            <h3>Ventas hoy</h3>
            <p>$<?= number_format($stats['ventas_hoy'], 2) ?></p>
        </div>
    </div>

    <h3>⚠ Stock Crítico</h3>
    <table class="table">
        <tr>
            <th>Producto</th>
            <th>Stock</th>
            <th>Alerta</th>
        </tr>
        <?php foreach ($stock_critico as $s): ?>
        <tr>
            <td><?= $s['descripcion_corta'] ?></td>
            <td style="color:red;"><?= $s['cantidad_actual'] ?></td>
            <td><?= $s['cantidad_minima_alerta'] ?></td>
        </tr>
        <?php endforeach ?>
    </table>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
