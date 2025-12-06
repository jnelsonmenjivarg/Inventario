<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content">

    <h2>Productos</h2>

    <a href="/productos/crear" class="btn-save">+ Nuevo Producto</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Proveedor</th>
                <th>Precio U.</th>
                <th>Precio Venta</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($productos as $p): ?>
                <tr>
                    <td><?= $p['id_producto'] ?></td>
                    <td><?= $p['descripcion_corta'] ?></td>
                    <td><?= $p['proveedor'] ?></td>
                    <td>$<?= $p['precio_unitario'] ?></td>
                    <td>$<?= $p['precio_venta'] ?></td>
                    <td><?= $p['cantidad_actual'] ?></td>

                    <td>
                        <a class="btn-edit" href="/productos/editar?id=<?= $p['id_producto'] ?>">Editar</a>
                        <a class="btn-delete" 
                           onclick="return confirm('¿Eliminar producto?')"
                           href="/productos/eliminar?id=<?= $p['id_producto'] ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
