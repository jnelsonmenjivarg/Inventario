<?php require __DIR__ .'/_styles.php'; ?>

<h1>Reporte de Ventas</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Documento</th>
            <th>Total</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($ventas as $v): ?>
        <tr>
            <td><?= $v['id_venta'] ?></td>
            <td><?= $v['cliente'] ?></td>
            <td><?= $v['fecha_venta'] ?></td>
            <td><?= $v['numero_documento'] ?></td>
            <td>$<?= number_format($v['monto_total'], 2) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
