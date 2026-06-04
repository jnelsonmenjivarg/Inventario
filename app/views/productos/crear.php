<?php require_once __DIR__ . '/../layout/header.php'; ?>
<div class="main-content">
    <div class="header-seccion">
        <h2>📦 Registro de Nuevo Producto</h2>
    </div>

    <?php if(!empty($errores)): ?>
    <div class="alert-danger"
        style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
        <strong>Por favor corrige los siguientes errores:</strong>
        <ul style="margin-top: 10px;">
            <?php foreach($errores as $e): ?>
            <li><?= $e ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <div class="card-form">
        <form action="/productos/crear" method="POST" class="form-grid">

            <div class="form-group">
                <label>Descripción Corta*</label>
                <input type="text" name="descripcion_corta" value="<?= $old['descripcion_corta'] ?? '' ?>" required
                    placeholder="Nombre comercial del producto">
            </div>

            <div class="form-group">
                <label>Proveedor*</label>
                <select name="id_proveedor" required>
                    <option value="">-- Seleccione Proveedor --</option>
                    <?php foreach($proveedores as $prov): ?>
                    <option value="<?= $prov['id_proveedor'] ?>"
                        <?= (isset($old['id_proveedor']) && $old['id_proveedor'] == $prov['id_proveedor']) ? 'selected' : '' ?>>
                        <?= $prov['descripcion_corta'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Presentación</label>
                <input type="text" name="presentacion" value="<?= $old['presentacion'] ?? '' ?>"
                    placeholder="Ej: Caja 12 und, Frasco 500ml">
            </div>

            <div class="form-group">
                <label>País de Origen</label>
                <input type="text" name="pais_origen" value="<?= $old['pais_origen'] ?? '' ?>">
            </div>

            <div class="form-group">
                <label>Precio Unitario (Costo)*</label>
                <input type="number" step="0.01" name="precio_unitario" value="<?= $old['precio_unitario'] ?? '' ?>"
                    required>
            </div>

            <div class="form-group">
                <label>Precio Venta*</label>
                <input type="number" step="0.01" name="precio_venta" value="<?= $old['precio_venta'] ?? '' ?>" required>
            </div>

            <div class="form-group">
                <label>Stock Inicial</label>
                <input type="number" name="cantidad_actual" value="<?= $old['cantidad_actual'] ?? '0' ?>">
            </div>

            <div class="form-group">
                <label>Stock Máximo Sugerido</label>
                <input type="number" name="cantidad_maxima" value="<?= $old['cantidad_maxima'] ?? '100' ?>">
            </div>

            <div class="form-group">
                <label>Código de Barras</label>
                <input type="text" name="codigo_barras" value="<?= $old['codigo_barras'] ?? '' ?>">
            </div>

            <div class="form-group full-width">
                <label>Descripción Larga / Especificaciones Técnicas</label>
                <textarea name="descripcion_larga" rows="4"><?= $old['descripcion_larga'] ?? '' ?></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">💾 Guardar Producto</button>
                <a href="/productos" class="btn-cancel">❌ Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>