<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content">
    <h2>Proveedores</h2>

    <a class="btn-save" href="/proveedores/crear">+ Nuevo Proveedor</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>País</th>
                <th>NIT/ID Tributario</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($proveedores as $p): ?>
                <tr>
                    <td><?= $p['id_proveedor'] ?></td>
                    <td><?= $p['descripcion_corta'] ?></td>
                    <td><?= $p['pais_origen'] ?></td>
                    <td><?= $p['id_tributario'] ?></td>
                    <td><?= $p['correo_proveedor'] ?></td>
                    <td>
                        <a class="btn-edit" href="/proveedores/editar?id=<?= $p['id_proveedor'] ?>">Editar</a>
                        <a class="btn-delete"
                           onclick="return confirm('¿Eliminar proveedor?')"
                           href="/proveedores/eliminar?id=<?= $p['id_proveedor'] ?>">
                           Eliminar
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
