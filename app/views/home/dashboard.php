<?php require "views/layout/header.php"; ?>
<?php require "views/layout/sidebar.php"; ?>

<div class="dashboard">

    <h1>Bodegón El Baratillo</h1>
    <p>Domicilio: 2a Calle Pte, Santa Tecla, La Libertad Centro.</p>

    <div class="cards">

        <div class="card">
            <img src="/public/icons/productos.svg">
            <h3>Productos</h3>
            <p>Total: <?= $totalProductos ?></p>
        </div>

        <div class="card">
            <img src="/public/icons/clientes.svg">
            <h3>Clientes</h3>
            <p>Total: <?= $totalClientes ?></p>
        </div>

        <div class="card">
            <img src="/public/icons/proveedores.svg">
            <h3>Proveedores</h3>
            <p>Total: <?= $totalProveedores ?></p>
        </div>

        <div class="card">
            <img src="/public/icons/ventas.svg">
            <h3>Ventas</h3>
            <p>Hoy: <?= $ventasHoy ?></p>
        </div>

    </div>

</div>

<?php require "views/layout/footer.php"; ?>
