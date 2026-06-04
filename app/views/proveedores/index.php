<?php 
$seccion_activa = true; 
include_once '../app/views/layout/header.php'; 
?>

<div class="container-blanco">
    <div class="header-seccion">
        <h2><i class="fas fa-city"></i> Gestión de Proveedores</h2>
        <button class="btn-nuevo" onclick="abrirModalProveedor()">+ Nuevo Proveedor</button>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>País</th>
                <th>ID Tributario</th>
                <th>Representante</th>
                <th>Correo</th>
                <th style="width: 100px; text-align: center;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($proveedores as $p): ?>
            <tr>
                <td><strong><?= htmlspecialchars($p['descripcion_corta']) ?></strong></td>
                <td><?= htmlspecialchars($p['pais_origen']) ?></td>
                <td><?= htmlspecialchars($p['id_tributario']) ?></td>
                <td><?= htmlspecialchars($p['representante_legal']) ?></td>
                <td><?= htmlspecialchars($p['correo_proveedor']) ?></td>
                <td style="text-align: center;">
                    <button class="btn-icon" style="color: #f39c12;" onclick='abrirModalProveedor(<?= json_encode($p) ?>)'>
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn-icon" style="color: #e74c3c;" onclick="confirmarEliminar(<?= $p['id_proveedor'] ?>, '<?= $p['descripcion_corta'] ?>')">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="modalProveedor" class="modal-flotante">
    <div class="modal-contenido" style="width: 650px;">
        <div style="background: #f8f9fa; padding: 20px; border-bottom: 1px solid #eee;">
            <h2 id="tituloModal" style="margin:0; color: #2c3e50;">Nuevo Proveedor</h2>
        </div>
        <form action="/proveedores/guardar" method="POST" style="padding: 25px;">
            <input type="hidden" name="id" id="prov_id">
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="campo-form">
                    <label>Nombre Comercial*</label>
                    <input type="text" name="descripcion_corta" id="prov_nombre" required style="width:100%; padding:8px; border:1px solid #ccc; border-radius:6px;">
                </div>
                <div class="campo-form">
                    <label>ID Tributario (NIT/RUC)*</label>
                    <input type="text" name="id_tributario" id="prov_nit" required style="width:100%; padding:8px; border:1px solid #ccc; border-radius:6px;">
                </div>
                <div class="campo-form">
                    <label>País de Origen</label>
                    <input type="text" name="pais_origen" id="prov_pais" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:6px;">
                </div>
                <div class="campo-form">
                    <label>Representante Legal</label>
                    <input type="text" name="representante_legal" id="prov_rep" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:6px;">
                </div>
                <div class="campo-form" style="grid-column: span 2;">
                    <label>Correo Electrónico</label>
                    <input type="email" name="correo_proveedor" id="prov_email" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:6px;">
                </div>
                <div class="campo-form" style="grid-column: span 2;">
                    <label>Razón Social / Descripción Larga</label>
                    <textarea name="descripcion_larga" id="prov_desc_larga" rows="2" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:6px;"></textarea>
                </div>
            </div>

            <div style="display:flex; justify-content: flex-end; gap:10px; margin-top:20px;">
                <button type="button" class="btn-cancelar-pro" onclick="cerrarModal()">Cancelar</button>
                <button type="submit" class="btn-guardar-pro">Guardar Proveedor</button>
            </div>
        </form>
    </div>
</div>

<script>
function abrirModalProveedor(datos = null) {
    document.getElementById('modalProveedor').style.display = 'flex';
    if (datos) {
        document.getElementById('tituloModal').innerText = 'Editar Proveedor';
        document.getElementById('prov_id').value = datos.id_proveedor;
        document.getElementById('prov_nombre').value = datos.descripcion_corta;
        document.getElementById('prov_nit').value = datos.id_tributario;
        document.getElementById('prov_pais').value = datos.pais_origen;
        document.getElementById('prov_rep').value = datos.representante_legal;
        document.getElementById('prov_email').value = datos.correo_proveedor;
        document.getElementById('prov_desc_larga').value = datos.descripcion_larga;
    } else {
        document.getElementById('tituloModal').innerText = 'Nuevo Proveedor';
        document.getElementById('prov_id').value = '';
        document.querySelector('#modalProveedor form').reset();
    }
}

function cerrarModal() { document.getElementById('modalProveedor').style.display = 'none'; }

function confirmarEliminar(id, nombre) {
    if (confirm(`¿Eliminar al proveedor "${nombre}"?`)) {
        window.location.href = `/proveedores/eliminar?id=${id}`;
    }
}
</script>

<?php include_once '../app/views/layout/footer.php'; ?>