<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content">

    <h2>Nueva Venta</h2>

    <form method="POST" action="/ventas/crear_post" id="ventaForm">

        <label>Cliente</label>
        <select name="id_cliente" required>
            <option value="">Seleccione</option>
            <?php foreach ($clientes as $c): ?>
                <option value="<?= $c['id_cliente'] ?>">
                    <?= $c['nombres'] . " " . $c['apellidos'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Tipo documento</label>
        <select name="tipo_documento" required>
            <option>Factura</option>
            <option>Ticket</option>
            <option>Crédito Fiscal</option>
        </select>

        <label>Número documento</label>
        <input type="text" name="numero_documento" required>

        <h3>Detalle</h3>

        <table class="table" id="tablaDetalle">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cant</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>

            <tbody></tbody>
        </table>

        <button type="button" class="btn-add" onclick="agregarFila()">+ Agregar producto</button>

        <h3>Total: $<span id="total">0.00</span></h3>
        <input type="hidden" name="monto_total" id="input_total">

        <button class="btn-save">Guardar Venta</button>

    </form>
</div>

<script>
const productos = <?= json_encode($productos) ?>;

function agregarFila() {
    const tbody = document.querySelector("#tablaDetalle tbody");

    const tr = document.createElement("tr");

    tr.innerHTML = `
        <td>
            <select name="items[][id_producto]" onchange="actualizarPrecio(this)">
                <option value="">Seleccione</option>
                ${productos.map(p => 
                    `<option value="${p.id_producto}" data-precio="${p.precio_venta}">
                        ${p.descripcion_corta}
                    </option>`
                ).join('')}
            </select>
        </td>

        <td><input type="number" name="items[][precio_unitario]" readonly></td>

        <td><input type="number" name="items[][cantidad]" min="1" value="1" onchange="calcularSubtotal(this)"></td>

        <td><input type="number" name="items[][subtotal]" readonly></td>

        <td><button type="button" onclick="this.parentNode.parentNode.remove(); actualizarTotal()">🗑</button></td>
    `;

    tbody.appendChild(tr);
}

function actualizarPrecio(select) {
    const precio = select.selectedOptions[0].dataset.precio;
    const row = select.closest("tr");
    row.querySelector("input[name='items[][precio_unitario]']").value = precio;
    calcularSubtotal(select);
}

function calcularSubtotal(input) {
    const row = input.closest("tr");
    const precio = parseFloat(row.querySelector("input[name='items[][precio_unitario]']").value || 0);
    const cantidad = parseInt(row.querySelector("input[name='items[][cantidad]']").value || 1);
    const subtotal = precio * cantidad;
    row.querySelector("input[name='items[][subtotal]']").value = subtotal.toFixed(2);
    actualizarTotal();
}

function actualizarTotal() {
    let total = 0;
    document.querySelectorAll("input[name='items[][subtotal]']").forEach(s => {
        total += parseFloat(s.value || 0);
    });
    document.querySelector("#total").innerText = total.toFixed(2);
    document.querySelector("#input_total").value = total.toFixed(2);
}
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
