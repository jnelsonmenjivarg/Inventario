<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content">

    <h2>Editar Usuario</h2>

    <form action="/usuarios/editar?id=<?= $usuario['id_usuario'] ?>" method="POST">

        <label>Nombre</label>
        <input type="text" name="nombre" 
               value="<?= $usuario['nombre'] ?>" required>

        <label>Email</label>
        <input type="email" name="email"
               value="<?= $usuario['email'] ?>" required>

        <label>Nueva contraseña (opcional)</label>
        <input type="password" name="password">

        <label>Rol asignado</label>
        <select name="id_rol" required>
            <?php foreach ($roles as $r): ?>
                <option value="<?= $r['id_rol'] ?>"
                    <?= ($usuario['id_rol'] == $r['id_rol']) ? 'selected' : '' ?>>
                    <?= $r['descripcion'] ?>
                </option>
            <?php endforeach ?>
        </select>

        <button class="btn-save">Actualizar</button>
        <a href="/usuarios" class="btn-back">Cancelar</a>

    </form>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
