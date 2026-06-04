<?php require __DIR__ .'/_styles.php'; ?>

<h1>Reporte de Compras</h1>
<p>Inventario El Baratillo – Santa Tecla</p>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Proveedor</th>
            <th>Fecha</th>
            <th>Documento</th>
            <th>Total</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($compras as $c): ?>
        <tr>
            <td><?= $c['id_compra'] ?></td>
            <td><?= $c['proveedor'] ?></td>
            <td><?= $c['fecha_compra'] ?></td>
            <td><?= $c['numero_documento'] ?></td>
            <td>$<?= number_format($c['monto_total'], 2) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p class="footer">Reporte generado: <?= date('d-m-Y h:i A') ?></p>
