<?php 
$seccion_activa = true; 
include_once '../app/views/layout/header.php'; 
?>

<div class="container-blanco">
    <div class="header-seccion">
        <h2><i class="fas fa-user-friends"></i> Gestión de Clientes</h2>
        <button class="btn-nuevo" onclick="abrirModalCliente()">+ Nuevo Cliente</button>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>NIT/DUI</th>
                <th>País</th>
                <th style="width: 100px; text-align: center;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $c): ?>
            <tr>
                <td><?= htmlspecialchars($c['nombres']) ?></td>
                <td><?= htmlspecialchars($c['apellidos']) ?></td>
                <td><?= htmlspecialchars($c['email']) ?></td>
                <td><?= htmlspecialchars($c['id_tributario']) ?></td>
                <td><?= htmlspecialchars($c['pais_origen']) ?></td>
                <td style="text-align: center;">
                    <button class="btn-icon" style="color: #f39c12; background:none; border:none; cursor:pointer;"
                        onclick='abrirModalCliente(<?= json_encode($c) ?>)'>
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn-icon" style="color: #e74c3c; background:none; border:none; cursor:pointer;"
                        onclick="confirmarEliminar(<?= $c['id_cliente'] ?>, '<?= $c['nombres'] ?>')">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="modalCliente" class="modal-flotante">
    <div class="modal-contenido" style="width: 600px;">
        <div style="background: #f8f9fa; padding: 20px; border-bottom: 1px solid #eee;">
            <h2 id="tituloModal" style="margin:0; color: #2c3e50;">Nuevo Cliente</h2>
        </div>
        <form action="/clientes/guardar" method="POST" style="padding: 25px;">
            <input type="hidden" name="id" id="cli_id">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="campo-form">
                    <label>Nombres*</label>
                    <input type="text" name="nombres" id="cli_nombres" required
                        style="width:100%; padding:8px; border:1px solid #ccc; border-radius:6px;">
                </div>
                <div class="campo-form">
                    <label>Apellidos*</label>
                    <input type="text" name="apellidos" id="cli_apellidos" required
                        style="width:100%; padding:8px; border:1px solid #ccc; border-radius:6px;">
                </div>
                <div class="campo-form">
                    <label>Email*</label>
                    <input type="email" name="email" id="cli_email" required
                        style="width:100%; padding:8px; border:1px solid #ccc; border-radius:6px;">
                </div>
                <div class="campo-form">
                    <label>ID Tributario (NIT/DUI)*</label>
                    <input type="text" name="id_tributario" id="cli_nit" required
                        style="width:100%; padding:8px; border:1px solid #ccc; border-radius:6px;">
                </div>
                <div class="campo-form">
                    <label>País de Origen</label>
                    <input type="text" name="pais_origen" id="cli_pais"
                        style="width:100%; padding:8px; border:1px solid #ccc; border-radius:6px;">
                </div>
                <div class="campo-form">
                    <label>Fecha Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" id="cli_fecha"
                        style="width:100%; padding:8px; border:1px solid #ccc; border-radius:6px;">
                </div>
            </div>

            <div style="display:flex; justify-content: flex-end; gap:10px; margin-top:20px;">
                <button type="button" class="btn-cancelar-pro" onclick="cerrarModal()">Cancelar</button>
                <button type="submit" class="btn-guardar-pro">Guardar Cliente</button>
            </div>
        </form>
    </div>
</div>

<script>
function abrirModalCliente(datos = null) {
    document.getElementById('modalCliente').style.display = 'flex';
    if (datos) {
        document.getElementById('tituloModal').innerText = 'Editar Cliente';
        document.getElementById('cli_id').value = datos.id_cliente;
        document.getElementById('cli_nombres').value = datos.nombres;
        document.getElementById('cli_apellidos').value = datos.apellidos;
        document.getElementById('cli_email').value = datos.email;
        document.getElementById('cli_nit').value = datos.id_tributario;
        document.getElementById('cli_pais').value = datos.pais_origen;
        document.getElementById('cli_fecha').value = datos.fecha_nacimiento;
    } else {
        document.getElementById('tituloModal').innerText = 'Nuevo Cliente';
        document.getElementById('cli_id').value = '';
        document.querySelector('#modalCliente form').reset();
    }
}

function cerrarModal() {
    document.getElementById('modalCliente').style.display = 'none';
}

function confirmarEliminar(id, nombre) {
    if (confirm(`¿Eliminar al cliente "${nombre}"?`)) {
        window.location.href = `/clientes/eliminar?id=${id}`;
    }
}
</script>

<?php include_once '../app/views/layout/footer.php'; ?>