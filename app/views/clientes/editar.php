<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content">

    <h2>Editar Cliente</h2>

    <form method="POST" action="/clientes/editar_post?id=<?= $cliente['id_cliente'] ?>">

        <label>Nombres</label>
        <input type="text" name="nombres" value="<?= $cliente['nombres'] ?>" required>

        <label>Apellidos</label>
        <input type="text" name="apellidos" value="<?= $cliente['apellidos'] ?>" required>

        <label>País origen</label>
        <input type="text" name="pais_origen" value="<?= $cliente['pais_origen'] ?>">

        <label>Fecha nacimiento</label>
        <input type="date" name="fecha_nacimiento" value="<?= $cliente['fecha_nacimiento'] ?>">

        <label>Email</label>
        <input type="email" name="email" value="<?= $cliente['email'] ?>" required>

        <label>NIT (id tributario)</label>
        <input type="text" name="id_tributario" value="<?= $cliente['id_tributario'] ?>" required>

        <button class="btn-save">Actualizar</button>

    </form>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
