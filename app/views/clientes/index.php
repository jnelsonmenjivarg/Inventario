<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content">

    <h2>Clientes</h2>

    <a class="btn-save" href="/clientes/crear">+ Nuevo Cliente</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>NIT</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($clientes as $c): ?>
            <tr>
                <td><?= $c['id_cliente'] ?></td>
                <td><?= $c['nombres'] ?></td>
                <td><?= $c['apellidos'] ?></td>
                <td><?= $c['email'] ?></td>
                <td><?= $c['id_tributario'] ?></td>

                <td>
                    <a class="btn-edit" href="/clientes/editar?id=<?= $c['id_cliente'] ?>">Editar</a>

                    <a class="btn-delete"
                       onclick="return confirm('¿Eliminar cliente?')"
                       href="/clientes/eliminar?id=<?= $c['id_cliente'] ?>">
                       Eliminar
                    </a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
