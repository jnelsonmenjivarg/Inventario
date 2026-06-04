<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content">

    <h2>Nuevo Cliente</h2>

    <form method="POST" action="/clientes/crear_post">

        <label>Nombres</label>
        <input type="text" name="nombres" required>

        <label>Apellidos</label>
        <input type="text" name="apellidos" required>

        <label>País origen</label>
        <input type="text" name="pais_origen">

        <label>Fecha nacimiento</label>
        <input type="date" name="fecha_nacimiento">

        <label>Email</label>
        <input type="email" name="email" required>

        <label>NIT (id tributario)</label>
        <input type="text" name="id_tributario" required>

        <button class="btn-save">Guardar</button>

    </form>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
