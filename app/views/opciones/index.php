<?php 
$seccion_activa = true; 
include_once '../app/views/layout/header.php'; 
?>

<div class="container-blanco">
    <div class="header-seccion">
        <h2>⚙️ Gestión de Opciones (Permisos)</h2>
        <button class="btn-nuevo" onclick="abrirModalOpcion()">+ Nueva Opción</button>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 80px;">ID</th>
                <th>Descripción de la Opción</th>
                <th>Estado</th>
                <th style="width: 120px; text-align: center;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($opciones)): ?>
                <?php foreach ($opciones as $o): ?>
                <tr>
                    <td><?= $o['id_opcion'] ?></td>
                    <td><?= htmlspecialchars($o['descripcion']) ?></td>
                    <td>
                        <span class="badge <?= $o['b_activa'] == 1 ? 'bg-success' : 'bg-danger' ?>">
                            <?= $o['b_activa'] == 1 ? 'Activa' : 'Inactiva' ?>
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <button class="btn-icon" style="color: #f39c12;" onclick='abrirModalOpcion(<?= json_encode($o) ?>)'>
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-icon" style="color: #e74c3c;" onclick="confirmarInactivar(<?= $o['id_opcion'] ?>, '<?= $o['descripcion'] ?>')">
                            <i class="fas fa-toggle-off"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4" style="text-align:center;">No hay opciones configuradas.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div id="modalOpcion" class="modal-flotante">
    <div class="modal-contenido" style="width: 450px;">
        <div style="background: #f8f9fa; padding: 20px; border-bottom: 1px solid #eee;">
            <h2 id="tituloModal" style="margin:0; color: #2c3e50;">Nueva Opción</h2>
        </div>
        <form action="/opciones/guardar" method="POST" style="padding: 25px;">
            <input type="hidden" name="id" id="opcion_id">
            <div class="campo-form">
                <label style="display:block; font-weight:bold; margin-bottom: 8px;">Nombre de la Opción:</label>
                <input type="text" name="descripcion" id="opcion_desc" required 
                       style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;"
                       placeholder="Ej: Gestionar Ventas, Ver Reportes...">
            </div>
            <div style="display:flex; justify-content: flex-end; gap:10px; margin-top:20px;">
                <button type="button" class="btn-cancelar-pro" onclick="cerrarModal()">Cancelar</button>
                <button type="submit" class="btn-guardar-pro">Guardar Datos</button>
            </div>
        </form>
    </div>
</div>

<script>
function abrirModalOpcion(datos = null) {
    document.getElementById('modalOpcion').style.display = 'flex';
    if (datos) {
        document.getElementById('tituloModal').innerText = 'Editar Opción';
        document.getElementById('opcion_id').value = datos.id_opcion;
        document.getElementById('opcion_desc').value = datos.descripcion;
    } else {
        document.getElementById('tituloModal').innerText = 'Nueva Opción';
        document.getElementById('opcion_id').value = '';
        document.getElementById('opcion_desc').value = '';
    }
}

function cerrarModal() { document.getElementById('modalOpcion').style.display = 'none'; }

function confirmarInactivar(id, nombre) {
    if (confirm(`¿Desea cambiar el estado de la opción: ${nombre}?`)) {
        window.location.href = `/opciones/eliminar?id=${id}`;
    }
}
</script>

<?php include_once '../app/views/layout/footer.php'; ?>