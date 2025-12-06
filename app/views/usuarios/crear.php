<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content">

    <h2>Registrar Nuevo Usuario</h2>

    <form action="/usuarios/crear" method="POST">

        <label>Nombre completo</label>
        <input type="text" name="nombre" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Contraseña</label>
        <input type="password" name="password" required>

        <label>Rol asignado</label>
        <select name="id_rol" required>
            <option value="">Seleccione</option>
            <?php foreach ($roles as $r): ?>
                <option value="<?= $r['id_rol'] ?>"><?= $r['descripcion'] ?></option>
            <?php endforeach ?>
        </select>

        <button class="btn-save">Guardar</button>
        <a href="/usuarios" class="btn-back">Cancelar</a>
    </form>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
