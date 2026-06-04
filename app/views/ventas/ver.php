<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content ticket">

    <h2>Venta #<?= $venta['id_venta'] ?></h2>

    <p><strong>Cliente:</strong> <?= $venta['cliente'] ?></p>
    <p><strong>Documento:</strong> <?= $venta['tipo_documento'] ?> #<?= $venta['numero_documento'] ?></p>
    <p><strong>Fecha:</strong> <?= $venta['fecha_venta'] ?></p>

    <h3>Detalle</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cant</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($detalles as $d): ?>
            <tr>
                <td><?= $d['descripcion_corta'] ?></td>
                <td>$<?= $d['precio_unitario'] ?></td>
                <td><?= $d['cantidad'] ?></td>
                <td>$<?= $d['subtotal'] ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <h3>Total: $<?= $venta['monto_total'] ?></h3>

    <a class="btn-back" href="/ventas">Regresar</a>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
