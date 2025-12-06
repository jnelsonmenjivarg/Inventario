<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content">

    <h2>Ventas</h2>

    <a class="btn-save" href="/ventas/crear">+ Nueva Venta</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Monto Total</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($ventas as $v): ?>
            <tr>
                <td><?= $v['id_venta'] ?></td>
                <td><?= $v['cliente'] ?></td>
                <td>$<?= $v['monto_total'] ?></td>
                <td><?= $v['fecha_venta'] ?></td>
                <td>
                    <a class="btn-edit" href="/ventas/ver?id=<?= $v['id_venta'] ?>">Ver</a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
