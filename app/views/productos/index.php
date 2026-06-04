<?php include_once '../app/views/layout/header.php'; ?>


<div class="container-blanco">
    <div class="header-seccion">
        <h2><i class="fas fa-boxes"></i> Inventario de Productos</h2>
        <button class="btn-nuevo" onclick="abrirModalProducto()">
            <i class="fas fa-plus"></i> Nuevo Producto
        </button>
    </div>
    <hr style="border: 1px solid #eee; margin-bottom: 20px;">

    <table style="width: 100%;">
    </table>
</div>


<div id="modalProducto" class="modal-flotante"
    style="display:none; align-items:center; justify-content:center; background:rgba(0,0,0,0.6); position:fixed; top:0; left:0; width:100%; height:100%; z-index:9999;">
    <div class="modal-contenido"
        style="background:white; padding:0; border-radius:12px; width:750px; overflow:hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.3);">

        <div
            style="background: #2c3e50; color: white; padding: 15px 25px; display: flex; justify-content: space-between; align-items: center;">
            <h3 id="modalTitulo" style="margin:0; font-size: 1.2rem;">Nuevo Producto</h3>
            <span onclick="cerrarModalProducto()" style="cursor:pointer; font-size: 20px;">&times;</span>
        </div>

        <form action="/productos/guardar" method="POST" id="formProducto" style="padding: 25px;">
            <input type="hidden" name="id_producto" id="id_producto">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">

                <div style="grid-column: span 2; border-bottom: 1px solid #eee; padding-bottom: 5px;">
                    <strong style="color: #2c3e50; font-size: 0.9rem;"><i class="fas fa-info-circle"></i> Información
                        General</strong>
                </div>

                <div>
                    <label style="display:block; margin-bottom:5px; font-size: 0.85rem;">Código de Barras:</label>
                    <input type="text" name="codigo" id="codigo" required
                        style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                </div>
                <div>
                    <label style="display:block; margin-bottom:5px; font-size: 0.85rem;">Nombre del Producto:</label>
                    <input type="text" name="nombre" id="nombre" required
                        style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                </div>
                <div style="grid-column: span 2;">
                    <label style="display:block; margin-bottom:5px; font-size: 0.85rem;">Descripción Detallada:</label>
                    <textarea name="detalle" id="detalle"
                        style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px; height: 50px; resize: none;"></textarea>
                </div>

                <div style="grid-column: span 2; border-bottom: 1px solid #eee; padding-bottom: 5px; margin-top: 10px;">
                    <strong style="color: #2c3e50; font-size: 0.9rem;"><i class="fas fa-dollar-sign"></i> Precios y
                        Existencias</strong>
                </div>

                <div>
                    <label style="display:block; margin-bottom:5px; font-size: 0.85rem;">Costo Unitario ($):</label>
                    <input type="number" step="0.01" name="costo" id="costo" required
                        style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                </div>
                <div>
                    <label style="display:block; margin-bottom:5px; font-size: 0.85rem;">Precio de Venta ($):</label>
                    <input type="number" step="0.01" name="venta" id="venta" required
                        style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                </div>
                <div>
                    <label style="display:block; margin-bottom:5px; font-size: 0.85rem;">Existencia Actual:</label>
                    <input type="number" name="stock" id="stock" required
                        style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                </div>
                <div>
                    <label style="display:block; margin-bottom:5px; font-size: 0.85rem;">Stock Máximo:</label>
                    <input type="number" name="stock_max" id="stock_max"
                        style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                </div>

                <div style="grid-column: span 2; border-bottom: 1px solid #eee; padding-bottom: 5px; margin-top: 10px;">
                    <strong style="color: #2c3e50; font-size: 0.9rem;"><i class="fas fa-barcode"></i> Control de Lote y
                        Logística</strong>
                </div>

                <div>
                    <label style="display:block; margin-bottom:5px; font-size: 0.85rem;">Número de Lote:</label>
                    <input type="text" name="lote" id="lote"
                        style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                </div>
                <div>
                    <label style="display:block; margin-bottom:5px; font-size: 0.85rem;">Fecha Vencimiento:</label>
                    <input type="date" name="fecha_vence" id="fecha_vence"
                        style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                </div>
                <div>
                    <label style="display:block; margin-bottom:5px; font-size: 0.85rem;">Proveedor:</label>
                    <select name="id_prov" id="id_prov"
                        style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                        <?php foreach($proveedores as $pr): ?>
                        <option value="<?= $pr['id_proveedor'] ?>"><?= $pr['descripcion_corta'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label style="display:block; margin-bottom:5px; font-size: 0.85rem;">Sucursal:</label>
                    <select name="id_suc" id="id_suc"
                        style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                        <?php foreach($sucursales as $s): ?>
                        <option value="<?= $s['id_sucursal'] ?>"><?= $s['nombre'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div style="margin-top: 30px; text-align: right; padding: 10px 0;">
                <button type="button" onclick="cerrarModalProducto()"
                    style="padding: 10px 20px; border: none; background: #95a5a6; color: white; border-radius: 4px; cursor: pointer; margin-right: 10px;">Cancelar</button>
                <button type="submit"
                    style="padding: 10px 25px; border: none; background: #27ae60; color: white; border-radius: 4px; cursor: pointer; font-weight: bold;">Guardar
                    Cambios</button>
            </div>
        </form>
    </div>
</div>

<script>
function abrirModalProducto() {
    document.getElementById('modalTitulo').innerText = 'Nuevo Producto';
    document.getElementById('formProducto').reset();
    document.getElementById('id_producto').value = '';
    document.getElementById('modalProducto').style.display = 'flex';
}

function editarProducto(p) {
    document.getElementById('modalTitulo').innerText = 'Editar Producto';

    // Asignamos valores por ID (más seguro que por nombre)
    document.getElementById('id_producto').value = p.id_producto;
    document.getElementById('codigo').value = p.codigo_barras;
    document.getElementById('nombre').value = p.descripcion_corta;
    document.getElementById('detalle').value = p.descripcion_larga;
    document.getElementById('costo').value = p.precio_unitario;
    document.getElementById('venta').value = p.precio_venta;
    document.getElementById('stock').value = p.cantidad_actual;
    document.getElementById('stock_max').value = p.cantidad_maxima;
    document.getElementById('lote').value = p.numero_lote || '';
    document.getElementById('fecha_vence').value = p.f_vencimiento || '';
    document.getElementById('id_prov').value = p.id_proveedor;
    document.getElementById('id_suc').value = p.id_sucursal;

    document.getElementById('modalProducto').style.display = 'flex';
}

function cerrarModalProducto() {
    document.getElementById('modalProducto').style.display = 'none';
}
</script>