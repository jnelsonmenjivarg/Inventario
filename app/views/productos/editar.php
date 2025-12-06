<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content">

    <h2>Editar Producto</h2>

    <form method="POST" action="/productos/editar_post?id=<?= $producto['id_producto'] ?>">

        <label>Descripción corta</label>
        <input type="text" name="descripcion_corta" required value="<?= $producto['descripcion_corta'] ?>">

        <label>Descripción larga</label>
        <textarea name="descripcion_larga"><?= $producto['descripcion_larga'] ?></textarea>

        <label>Presentación</label>
        <input type="text" name="presentacion" value="<?= $producto['presentacion'] ?>">

        <label>País origen</label>
        <input type="text" name="pais_origen" value="<?= $producto['pais_origen'] ?>">

        <label>Cantidad máxima</label>
        <input type="number" name="cantidad_maxima" value="<?= $producto['cantidad_maxima'] ?>" required>

        <label>Cantidad actual</label>
        <input type="number" name="cantidad_actual" value="<?= $producto['cantidad_actual'] ?>" required>

        <label>Precio unitario</label>
        <input type="number" step="0.01" name="precio_unitario" value="<?= $producto['precio_unitario'] ?>" required>

        <label>Precio venta</label>
        <input type="number" step="0.01" name="precio_venta" value="<?= $producto['precio_venta'] ?>" required>

        <label>Código de barras</label>
        <input type="text" name="codigo_barras" value="<?= $producto['codigo_barras'] ?>">

        <label>Proveedor</label>
        <select name="id_proveedor" required>
            <?php foreach ($proveedores as $pr): ?>
                <option value="<?= $pr['id_proveedor'] ?>"
                    <?= $producto['id_proveedor'] == $pr['id_proveedor'] ? 'selected' : '' ?>>
                    <?= $pr['descripcion_corta'] ?>
                </option>
            <?php endforeach ?>
        </select>

        <button class="btn-save">Actualizar</button>

    </form>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
