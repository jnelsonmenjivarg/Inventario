<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content">
    <h2>Compras</h2>

    <a class="btn-save" href="/compras/crear">+ Nueva Compra</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Proveedor</th>
                <th>Fecha</th>
                <th>Documento</th>
                <th>Monto total</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($compras as $c): ?>
            <tr>
                <td><?= $c['id_compra'] ?></td>
                <td><?= $c['proveedor'] ?></td>
                <td><?= $c['fecha_compra'] ?></td>
                <td><?= $c['numero_documento'] ?></td>
                <td>$<?= $c['monto_total'] ?></td>
                <td>
                    <a class="btn-edit" href="/compras/ver?id=<?= $c['id_compra'] ?>">Ver</a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
