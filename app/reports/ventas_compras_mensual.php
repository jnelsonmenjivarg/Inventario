<?php require __DIR__ .'/_styles.php'; ?>

<h1>Reporte Mensual</h1>
<h3>Ventas vs Compras</h3>

<table>
    <thead>
        <tr>
            <th>Mes</th>
            <th>Total Ventas</th>
            <th>Total Compras</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ventasMensuales as $mes => $venta): ?>
        <tr>
            <td><?= $mes ?></td>
            <td>$<?= number_format($venta, 2) ?></td>
            <td>$<?= number_format($comprasMensuales[$mes] ?? 0, 2) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
