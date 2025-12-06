<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content">
    <h2>Roles del Sistema</h2>

    <a href="/roles/crear" class="btn-save">Crear Rol</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($roles as $r): ?>
            <tr>
                <td><?= $r['id_rol'] ?></td>
                <td><?= $r['descripcion'] ?></td>
                <td>
                    <a class="btn-edit" href="/roles/editar?id=<?= $r['id_rol'] ?>">Editar</a>
                    <a class="btn-delete" onclick="return confirm('¿Eliminar este rol?')"
                        href="/roles/eliminar?id=<?= $r['id_rol'] ?>">
                        Eliminar
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>