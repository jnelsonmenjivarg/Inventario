<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content">
    <h2>Inventario General</h2>

    <a href="/inventario/crear" class="btn-save">Registrar Inventario</a>

    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Sucursal</th>
                <th>Cantidad</th>
                <th>Alerta</th>
                <th>Depto</th>
                <th>Municipio</th>
                <th>Distrito</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($inventario as $i): ?>
            <tr>
                <td><?= $i['producto'] ?></td>
                <td><?= $i['id_sucursal'] ?></td>
                <td><?= $i['cantidad_actual'] ?></td>
                <td><?= $i['cantidad_minima_alerta'] ?></td>
                <td><?= $i['id_departamento'] ?></td>
                <td><?= $i['id_municipio'] ?></td>
                <td><?= $i['id_distrito'] ?></td>
                <td>
                    <a class="btn-edit" href="/inventario/editar/<?= $i['id_producto'] ?>/<?= $i['id_sucursal'] ?>">Editar</a>
                    <a class="btn-delete"
                       onclick="return confirm('Confirmar eliminación?')"
                       href="/inventario/eliminar/<?= $i['id_producto'] ?>/<?= $i['id_sucursal'] ?>">Eliminar</a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
