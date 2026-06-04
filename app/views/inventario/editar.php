<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content">

    <h2>Editar Inventario</h2>

    <form action="/inventario/editar/<?= $item['id_producto'] ?>/<?= $item['id_sucursal'] ?>" method="POST">

        <label>Producto</label>
        <select name="id_producto" disabled>
            <?php foreach ($productos as $p): ?>
                <option value="<?= $p['id_producto'] ?>"
                    <?= $p['id_producto'] == $item['id_producto'] ? 'selected' : '' ?>>
                    <?= $p['descripcion_corta'] ?>
                </option>
            <?php endforeach ?>
        </select>

        <label>Cantidad actual *</label>
        <input type="number" name="cantidad_actual"
               value="<?= $item['cantidad_actual'] ?>" required>

        <label>Cantidad mínima alerta *</label>
        <input type="number" name="cantidad_minima_alerta"
               value="<?= $item['cantidad_minima_alerta'] ?>" required>

        <label>Departamento *</label>
        <select name="id_departamento" required>
            <?php foreach ($departamentos as $d): ?>
                <option value="<?= $d['id_departamento'] ?>"
                    <?= $d['id_departamento'] == $item['id_departamento'] ? 'selected' : '' ?>>
                    <?= $d['descripcion'] ?>
                </option>
            <?php endforeach ?>
        </select>

        <label>Municipio *</label>
        <select name="id_municipio" required>
            <?php foreach ($municipios as $m): ?>
                <option value="<?= $m['id_municipio'] ?>"
                    <?= $m['id_municipio'] == $item['id_municipio'] ? 'selected' : '' ?>>
                    <?= $m['descripcion'] ?>
                </option>
            <?php endforeach ?>
        </select>

        <label>Distrito *</label>
        <select name="id_distrito" required>
            <?php foreach ($distritos as $d): ?>
                <option value="<?= $d['id_distrito'] ?>"
                    <?= $d['id_distrito'] == $item['id_distrito'] ? 'selected' : '' ?>>
                    <?= $d['descripcion'] ?>
                </option>
            <?php endforeach ?>
        </select>

        <button class="btn-save">Actualizar</button>
        <a class="btn-back" href="/inventario">Cancelar</a>

    </form>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
 