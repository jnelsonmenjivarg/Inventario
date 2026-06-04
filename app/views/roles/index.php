<?php include_once '../app/views/layout/header.php'; ?>

<div class="header-seccion">
    <h2>🔑 Gestión de Roles</h2>
    <button class="btn-nuevo" onclick="abrirModalRol()">+ Nuevo Rol</button>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th style="width: 80px;">ID</th>
                <th>Descripción del Rol</th>
                <th style="width: 120px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($roles)): ?>
                <?php foreach ($roles as $r): ?>
                <tr>
                    <td><?= $r['id_rol'] ?></td>
                    <td><?= htmlspecialchars($r['descripcion']) ?></td>
                    <td style="text-align: center;">
                        <button class="btn-icon" style="color: #f39c12; background:none; border:none; cursor:pointer;" 
                                onclick='abrirModalRol(<?= json_encode($r) ?>)'>
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-icon" style="color: #e74c3c; background:none; border:none; cursor:pointer;" 
                                onclick="confirmarEliminarRol(<?= $r['id_rol'] ?>, '<?= $r['descripcion'] ?>')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3" style="text-align:center;">No hay roles registrados.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div id="modalRol" class="modal-flotante">
    <div class="modal-contenido" style="width: 400px; background: #fff !important; border-radius: 12px; border: 2px solid #34495e;">
        <div style="background: #f8f9fa; padding: 20px; border-bottom: 1px solid #eee;">
            <h2 id="tituloModal" style="margin:0; color: #2c3e50;">Nuevo Rol</h2>
        </div>
        <form action="/roles/guardar" method="POST" style="padding: 25px;">
            <input type="hidden" name="id" id="rol_id">
            <div class="campo-form">
                <label style="display:block; font-weight:bold; margin-bottom: 8px;">Descripción del Rol:</label>
                <input type="text" name="descripcion" id="rol_descripcion" required 
                       style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;"
                       placeholder="Ej: Administrador, Vendedor...">
            </div>
            <div style="display:flex; justify-content: flex-end; gap:10px; margin-top:20px;">
                <button type="button" class="btn-cancelar-pro" onclick="cerrarModal()">Cancelar</button>
                <button type="submit" class="btn-guardar-pro">Guardar Rol</button>
            </div>
        </form>
    </div>
</div>

<script>
function abrirModalRol(datos = null) {
    document.getElementById('modalRol').style.display = 'flex';
    if (datos) {
        document.getElementById('tituloModal').innerText = 'Editar Rol';
        document.getElementById('rol_id').value = datos.id_rol;
        document.getElementById('rol_descripcion').value = datos.descripcion;
    } else {
        document.getElementById('tituloModal').innerText = 'Nuevo Rol';
        document.getElementById('rol_id').value = '';
        document.getElementById('rol_descripcion').value = '';
    }
}

function cerrarModal() { document.getElementById('modalRol').style.display = 'none'; }

function confirmarEliminarRol(id, nombre) {
    if (confirm(`¿Desea eliminar el rol: ${nombre}?`)) {
        window.location.href = `/roles/eliminar?id=${id}`;
    }
}
</script>

<?php include_once '../app/views/layout/footer.php'; ?>