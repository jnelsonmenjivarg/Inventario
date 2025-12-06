<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content">

    <h2>Usuarios del Sistema</h2>

    <a href="/usuarios/crear" class="btn-save">+ Nuevo Usuario</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($usuarios as $u): ?>
            <tr>
                <td><?= $u['id_usuario'] ?></td>
                <td><?= $u['nombre'] ?></td>
                <td><?= $u['email'] ?></td>
                <td><?= $u['rol'] ?></td>
                <td>
                    <a href="/usuarios/editar?id=<?= $u['id_usuario'] ?>" class="btn-edit">Editar</a>
                    <a href="/usuarios/eliminar?id=<?= $u['id_usuario'] ?>" 
                       onclick="return confirm('¿Eliminar usuario?')"
                       class="btn-delete">
                        Eliminar
                    </a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
