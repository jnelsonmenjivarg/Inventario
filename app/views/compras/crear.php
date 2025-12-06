<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content">

    <h2>Nueva Compra</h2>

    <form method="POST" action="/compras/crear_post" id="form-compra">

        <label>Proveedor</label>
        <select name="id_proveedor" required>
            <option value="">Seleccione...</option>
            <?php foreach ($proveedores as $p): ?>
                <option value="<?= $p['id_proveedor'] ?>">
                    <?= $p['descripcion_corta'] ?>
                </option>
            <?php endforeach ?>
        </select>

        <label>Número de documento</label>
        <input type="text" name="numero_documento" required>

        <h3>Detalle de productos</h3>

        <table class="table" id="tabla-detalle">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio U.</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="detalle-body">
                <tr>
                    <td>
                        <select name="id_producto[]" required>
                            <option value="">Seleccione...</option>
                            <?php foreach ($productos as $pr): ?>
                                <option value="<?= $pr['id_producto'] ?>">
                                    <?= $pr['descripcion_corta'] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </td>
                    <td><input type="number" name="cantidad[]" min="1" value="1" required></td>
                    <td><input type="number" name="precio_unitario[]" step="0.01" min="0" value="0" required></td>
                    <td class="subtotal">0.00</td>
                    <td><button type="button" class="btn-delete" onclick="eliminarFila(this)">X</button></td>
                </tr>
            </tbody>
        </table>

        <button type="button" class="btn-save" onclick="agregarFila()">+ Agregar producto</button>

        <h3>Total: $<span id="total-compra">0.00</span></h3>

        <button class="btn-save" type="submit">Guardar compra</button>

    </form>

</div>

<script>
function recalcular() {
    let total = 0;
    document.querySelectorAll('#detalle-body tr').forEach(tr => {
        const cant = parseFloat(tr.querySelector('input[name="cantidad[]"]').value || 0);
        const precio = parseFloat(tr.querySelector('input[name="precio_unitario[]"]').value || 0);
        const sub = cant * precio;
        tr.querySelector('.subtotal').textContent = sub.toFixed(2);
        total += sub;
    });
    document.getElementById('total-compra').textContent = total.toFixed(2);
}

function agregarFila() {
    const body = document.getElementById('detalle-body');
    const primera = body.querySelector('tr');
    const nueva = primera.cloneNode(true);

    nueva.querySelectorAll('select, input').forEach(el => {
        if (el.tagName === 'SELECT') el.selectedIndex = 0;
        if (el.tagName === 'INPUT') el.value = el.name.includes('cantidad') ? 1 : 0;
    });
    nueva.querySelector('.subtotal').textContent = '0.00';

    body.appendChild(nueva);
}

function eliminarFila(btn) {
    const body = document.getElementById('detalle-body');
    if (body.querySelectorAll('tr').length === 1) return;
    btn.closest('tr').remove();
    recalcular();
}

document.getElementById('detalle-body').addEventListener('input', recalcular);
recalcular();
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
