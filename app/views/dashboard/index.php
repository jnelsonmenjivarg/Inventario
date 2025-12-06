<?php
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/sidebar.php';
?>

<div class="topbar">
    <h1>Bienvenido, <?= $_SESSION['usuario']['nombre']; ?> 👋</h1>
</div>

<div class="content">

    <div class="cards">

        <div class="card">
            <h3>Productos</h3>
            <p>Total: <?= $totalProductos ?? 0 ?></p>
        </div>

        <div class="card">
            <h3>Clientes</h3>
            <p>Total: <?= $totalClientes ?? 0 ?></p>
        </div>

        <div class="card">
            <h3>Usuarios</h3>
            <p>Total: <?= $totalUsuarios ?? 0 ?></p>
        </div>

        <div class="card">
            <h3>Ventas Hoy</h3>
            <p>$<?= $ventasHoy ?? 0 ?></p>
        </div>

    </div>

</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>