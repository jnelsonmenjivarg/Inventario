<?php require __DIR__ .'/_styles.php'; ?>

<h1>Productos en Stock</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Stock Total</th>
            <th>Precio de Venta</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($productos as $p): ?>
        <tr>
            <td><?= $p['id_producto'] ?></td>
            <td><?= $p['descripcion_corta'] ?></td>
            <td><?= $p['cantidad_actual'] ?></td>
            <td>$<?= number_format($p['precio_venta'], 2) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
