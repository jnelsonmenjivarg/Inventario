<?php require __DIR__ .'/_style.php'; ?>

<h1>Reporte de Existencias</h1>

<table>
    <thead>
        <tr>
            <th>Producto</th>
            <th>Código</th>
            <th>Stock</th>
            <th>Precio</th>
            <th>Proveedor</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($existencias as $e): ?>
        <tr>
            <td><?= $e['descripcion_corta'] ?></td>
            <td><?= $e['id_producto'] ?></td>
            <td><?= $e['cantidad_total'] ?></td>
            <td>$<?= $e['precio_unitario'] ?></td>
            <td><?= $e['proveedor'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>

</table>

<p class="footer">Inventario actualizado al <?= date('d-m-Y') ?></p>
