<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content">

    <h2>Registrar Inventario</h2>

    <form action="/inventario/crear" method="POST">

        <label>Producto *</label>
        <select name="id_producto" required>
            <option value="">Seleccione</option>
            <?php foreach ($productos as $p): ?>
                <option value="<?= $p['id_producto'] ?>"><?= $p['descripcion_corta'] ?></option>
            <?php endforeach ?>
        </select>

        <label>ID Sucursal *</label>
        <input type="number" name="id_sucursal" required>

        <label>Cantidad actual *</label>
        <input type="number" name="cantidad_actual" required>

        <label>Cantidad mínima alerta *</label>
        <input type="number" name="cantidad_minima_alerta" required>

        <label>Departamento *</label>
        <select name="id_departamento" required>
            <?php foreach ($departamentos as $d): ?>
                <option value="<?= $d['id_departamento'] ?>"><?= $d['descripcion'] ?></option>
            <?php endforeach ?>
        </select>

        <label>Municipio *</label>
        <select name="id_municipio" required>
            <?php foreach ($municipios as $m): ?>
                <option value="<?= $m['id_municipio'] ?>"><?= $m['descripcion'] ?></option>
            <?php endforeach ?>
        </select>

        <label>Distrito *</label>
        <select name="id_distrito" required>
            <?php foreach ($distritos as $k => $d): ?>
                <option value="<?= $d['id_distrito'] ?>"><?= $d['descripcion'] ?></option>
            <?php endforeach ?>
        </select>

        <button class="btn-save">Guardar</button>
        <a class="btn-back" href="/inventario">Cancelar</a>

    </form>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
