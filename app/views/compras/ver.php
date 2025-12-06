<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content">

    <h2>Compra #<?= $compra['id_compra'] ?></h2>

    <p><strong>Proveedor:</strong> <?= $compra['proveedor'] ?></p>
    <p><strong>Fecha:</strong> <?= $compra['fecha_compra'] ?></p>
    <p><strong>Documento:</strong> <?= $compra['numero_documento'] ?></p>
    <p><strong>Total:</strong> $<?= $compra['monto_total'] ?></p>

    <h3>Detalle</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio U.</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detalles as $d): ?>
            <tr>
                <td><?= $d['producto'] ?></td>
                <td><?= $d['cantidad'] ?></td>
                <td>$<?= $d['precio_unitario'] ?></td>
                <td>$<?= $d['subtotal'] ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <a href="/compras" class="btn-back">← Volver a listado</a>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
