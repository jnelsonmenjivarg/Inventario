<?php 
$seccion_activa = true; 
include_once '../app/views/layout/header.php'; 
?>

<div class="container-blanco">
    <h2><i class="fas fa-shopping-cart"></i> Nueva Venta</h2>
    <hr>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
        <div class="campo-form">
            <label><strong>Cliente:</strong></label>
            <select id="id_cliente" class="form-control" style="width: 100%; padding: 10px;">
                <option value="">-- Seleccionar Cliente --</option>
                <?php foreach($clientes as $c): ?>
                <option value="<?= $c['id_cliente'] ?>"><?= $c['nombres'] ?> <?= $c['apellidos'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="campo-form">
            <label><strong>Sucursal de Venta:</strong></label>
            <select id="id_sucursal" class="form-control" style="width: 100%; padding: 10px;">
                <option value="">-- Seleccione Sucursal --</option>
                <?php foreach($sucursales as $s): ?>
                <option value="<?= $s['id_sucursal'] ?>"><?= $s['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="campo-form" style="grid-column: span 2;">
            <label><strong>Agregar Producto:</strong></label>
            <select id="select_producto" class="form-control" style="width: 100%; padding: 10px;"
                onchange="agregarFila()">
                <option value="">-- Buscar Producto --</option>
                <?php foreach($productos as $p): ?>
                <option value="<?= $p['id_producto'] ?>" data-precio="<?= $p['precio_venta'] ?>"
                    data-stock="<?= $p['cantidad_actual'] ?>">
                    <?= $p['descripcion_corta'] ?> (Stock: <?= $p['cantidad_actual'] ?>)
                </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <table id="tabla-detalle" class="table">
        <thead>
            <tr style="background: #2c3e50; color: white;">
                <th>Producto</th>
                <th style="width: 120px;">Precio</th>
                <th style="width: 100px;">Cantidad</th>
                <th style="width: 120px;">Subtotal</th>
                <th style="width: 50px;"></th>
            </tr>
        </thead>
        <tbody id="cuerpo-detalle">
        </tbody>
    </table>

    <div style="text-align: right; margin-top: 20px;">
        <h3 style="margin-bottom: 20px;">TOTAL: $<span id="total-venta">0.00</span></h3>
        <button class="btn-guardar-pro"
            style="padding: 15px 50px; background-color: #27ae60; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;"
            onclick="finalizarProcesoVenta()">
            <i class="fas fa-check-circle"></i> FINALIZAR VENTA
        </button>
    </div>
</div>

<script>
let carrito = [];

function agregarFila() {
    const select = document.getElementById('select_producto');
    const option = select.options[select.selectedIndex];

    if (!option.value) return;

    const id = option.value;
    const nombre = option.text;
    const precio = parseFloat(option.getAttribute('data-precio'));
    const stock = parseInt(option.getAttribute('data-stock'));

    if (stock <= 0) {
        alert("Este producto no tiene stock disponible");
        return;
    }

    const existe = carrito.find(p => p.id === id);
    if (existe) {
        alert("El producto ya está en la lista");
        return;
    }

    carrito.push({
        id,
        nombre,
        precio,
        cantidad: 1,
        stock
    });
    renderTabla();
    select.value = "";
}

function renderTabla() {
    const cuerpo = document.getElementById('cuerpo-detalle');
    cuerpo.innerHTML = "";
    let total = 0;

    carrito.forEach((p, index) => {
        let subtotal = p.precio * p.cantidad;
        total += subtotal;
        cuerpo.innerHTML += `
            <tr>
                <td>${p.nombre}</td>
                <td>$${p.precio.toFixed(2)}</td>
                <td>
                    <input type="number" value="${p.cantidad}" min="1" max="${p.stock}" 
                    onchange="actualizarCantidad(${index}, this.value)" style="width:60px; padding:5px;">
                </td>
                <td>$${subtotal.toFixed(2)}</td>
                <td><button onclick="eliminarProd(${index})" style="color:red; border:none; background:none; cursor:pointer;"><i class="fas fa-times"></i></button></td>
            </tr>
        `;
    });
    document.getElementById('total-venta').innerText = total.toFixed(2);
}

function actualizarCantidad(index, valor) {
    const v = parseInt(valor);
    if (v > carrito[index].stock) {
        alert("No hay suficiente stock. Stock máximo: " + carrito[index].stock);
        carrito[index].cantidad = carrito[index].stock;
    } else if (v <= 0 || isNaN(v)) {
        carrito[index].cantidad = 1;
    } else {
        carrito[index].cantidad = v;
    }
    renderTabla();
}

function eliminarProd(index) {
    carrito.splice(index, 1);
    renderTabla();
}

function finalizarProcesoVenta() {
    const id_cliente = document.getElementById('id_cliente').value;
    const id_sucursal = document.getElementById('id_sucursal').value;
    const totalVenta = parseFloat(document.getElementById('total-venta').innerText);

    if (!id_cliente || !id_sucursal || carrito.length === 0) {
        alert("⚠️ Complete los datos: Cliente, Sucursal y al menos un producto.");
        return;
    }

    const data = {
        id_cliente: id_cliente,
        id_sucursal: id_sucursal,
        total: totalVenta,
        productos: carrito
    };

    fetch('/ventas/guardar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(res => res.json())
        .then(res => {
            if (res.status === 'ok') {
                // 1. Preguntar por la impresión
                if (confirm("✅ Venta #" + res.id_venta + " guardada.\n¿Desea imprimir el ticket ahora?")) {
                    window.open('/ventas/imprimir?id=' + res.id_venta, '_blank');
                }

                // 2. LIMPIAR EL FORMULARIO (Sin recargar la página para no perder velocidad)
                carrito = [];
                document.getElementById('id_cliente').value = "";
                document.getElementById('id_sucursal').value = "";
                document.getElementById('select_producto').value = "";
                renderTabla();

                // 3. OPCIONAL: Si quieres ir a la lista de ventas, descomenta la siguiente línea:
                // window.location.href = "/ventas";

                alert("Venta procesada con éxito.");
            } else {
                alert("❌ Error: " + res.message);
            }
        })
        .catch(err => {
            console.error(err);
            alert("Ocurrió un error al procesar la venta");
        });
}
</script>

<?php include_once '../app/views/layout/footer.php'; ?>