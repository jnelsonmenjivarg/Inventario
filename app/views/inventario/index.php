    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <?php include_once '../app/views/layout/header.php'; ?>

    <style>
.modal-flotante {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    justify-content: center;
    align-items: center;
}

.modal-contenido {
    background: white;
    padding: 30px;
    border-radius: 10px;
    width: 450px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
}

.campo-form {
    margin-bottom: 15px;
}

.campo-form label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.campo-form input {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
}
    </style>

    <div class="header-seccion">
        <h2>📦 Gestión de Inventario</h2>
        <button class="btn-nuevo" onclick="abrirModalInventario()">+ Nuevo Producto</button>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Proveedor</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th style="width: 100px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $p): ?>
            <tr>
                <td><?= $p['id_producto'] ?></td>
                <td><?= $p['descripcion_corta'] ?></td>
                <td><?= $p['proveedor'] ?></td>
                <td><?= $p['cantidad_actual'] ?></td>
                <td>$<?= number_format($p['precio_venta'], 2) ?></td>
                <td>
                    <button class="btn-icon" style="color: #f39c12; background:none; border:none; cursor:pointer;"
                        onclick='abrirModalInventario(<?= json_encode($p) ?>)' title="Editar">
                        <i class="fas fa-edit"></i>
                    </button>

                    <button class="btn-icon" style="color: #e74c3c; background:none; border:none; cursor:pointer;"
                        onclick="confirmarEliminar(<?= $p['id_producto'] ?>, '<?= $p['descripcion_corta'] ?>', 'inventario')"
                        title="Eliminar">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="6" style="text-align:center;">No hay productos registrados.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div id="miModal" class="modal-flotante">
        <div class="modal-contenido" style="width: 600px;">
            <h2 id="tituloModal">Nuevo Producto</h2>
            <form action="/inventario/guardar" method="POST">
                <input type="hidden" name="id" id="id_prod">

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="campo-form">
                        <label>Descripción Corta*</label>
                        <input type="text" name="descripcion_corta" id="desc_corta" required>
                    </div>
                    <div class="campo-form">
                        <label>Proveedor*</label>
                        <select name="id_proveedor" id="id_prov" style="width:100%; padding:8px;" required>
                            <option value="">-- Seleccione --</option>
                            <?php foreach($proveedores as $prov): ?>
                            <option value="<?= $prov['id_proveedor'] ?>"><?= $prov['descripcion_corta'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="campo-form">
                        <label>Presentación</label>
                        <input type="text" name="presentacion" id="pres_prod">
                    </div>
                    <div class="campo-form">
                        <label>País Origen</label>
                        <input type="text" name="pais_origen" id="pais_prod">
                    </div>

                    <div class="campo-form">
                        <label>Precio Costo*</label>
                        <input type="number" step="0.01" name="precio_unitario" id="prec_u" required>
                    </div>
                    <div class="campo-form">
                        <label>Precio Venta*</label>
                        <input type="number" step="0.01" name="precio_venta" id="prec_v" required>
                    </div>

                    <div class="campo-form">
                        <label>Stock Actual</label>
                        <input type="number" name="cantidad_actual" id="stock_a">
                    </div>
                    <div class="campo-form">
                        <label>Stock Máximo</label>
                        <input type="number" name="cantidad_maxima" id="stock_m">
                    </div>
                </div>

                <div class="campo-form">
                    <label>Código de Barras</label>
                    <input type="text" name="codigo_barras" id="cod_barras">
                </div>

                <div class="campo-form">
                    <label>Descripción Larga</label>
                    <textarea name="descripcion_larga" id="desc_larga" style="width:100%;" rows="2"></textarea>
                </div>

                <div style="display:flex; justify-content: flex-end; gap:10px; margin-top:20px;">
                    <button type="button" class="btn-danger" onclick="cerrarMiModal()">Cancelar</button>
                    <button type="submit" class="btn-nuevo">Guardar Datos</button>
                </div>
            </form>
        </div>
    </div>

    <script>
function abrirModalInventario(datos = null) {
    const modal = document.getElementById('miModal');
    modal.style.display = 'flex';

    if (datos) {
        // Modo Editar: Cargar datos
        document.getElementById('tituloModal').innerText = 'Editar Producto';
        document.getElementById('id_prod').value = datos.id_producto;
        document.getElementById('desc_corta').value = datos.descripcion_corta;
        document.getElementById('id_prov').value = datos.id_proveedor;
        document.getElementById('pres_prod').value = datos.presentacion;
        document.getElementById('pais_prod').value = datos.pais_origen;
        document.getElementById('prec_u').value = datos.precio_unitario;
        document.getElementById('prec_v').value = datos.precio_venta;
        document.getElementById('stock_a').value = datos.cantidad_actual;
        document.getElementById('stock_m').value = datos.cantidad_maxima;
        document.getElementById('cod_barras').value = datos.codigo_barras;
        document.getElementById('desc_larga').value = datos.descripcion_larga;
    } else {
        document.getElementById('tituloModal').innerText = 'Nuevo Producto';
        // Limpiar formulario para NUEVO
        document.getElementById('id_prod').value = '';
        document.querySelector('#miModal form').reset();
    }
}

function cerrarMiModal() {
    document.getElementById('miModal').style.display = 'none';
}

function confirmarEliminar(id, nombre, entidad) {
    if (confirm(`¿Estás seguro de eliminar "${nombre}"?`)) {
        window.location.href = `/${entidad}/eliminar?id=${id}`;
    }
}
    </script>


    <!--  <td class="acciones">
        <button class="btn-icon btn-edit" onclick='abrirModalInventario(<?= json_encode($p) ?>)'
            title="Editar Producto">
            <i class="fas fa-edit"></i>
        </button>

        <button class="btn-icon btn-danger"
            onclick="confirmarEliminar(<?= $p['id_producto'] ?>, '<?= $p['descripcion_corta'] ?>', 'inventario')"
            title="Eliminar Producto">
            <i class="fas fa-trash-alt"></i>
        </button>
    </td> -->

    <?php include_once '../app/views/layout/footer.php'; ?>