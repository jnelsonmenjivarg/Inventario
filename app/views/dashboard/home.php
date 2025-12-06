<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content">
    <h1>Bienvenido al Bodegón "El Baratillo"</h1>
    <p>Domicilio: 2a Calle Pte, Santa Tecla, La Libertad Centro.</p>

    <div class="cards">

        <div class="card">
            <h3>Usuarios</h3>
            <a href="/usuarios">Administrar</a>
        </div>

        <div class="card">
            <h3>Clientes</h3>
            <a href="/clientes">Ver Clientes</a>
        </div>

        <div class="card">
            <h3>Productos</h3>
            <a href="/productos">Inventario</a>
        </div>

        <div class="card">
            <h3>Ventas</h3>
            <a href="/ventas">Registrar venta</a>
        </div>

    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>