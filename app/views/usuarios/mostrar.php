<?php include_once '../app/views/layout/header.php'; ?>

<div class="container-blanco">
    <div class="header-seccion">
        <h2>👤 Gestión de Usuarios</h2>
        <button class="btn-nuevo" onclick="abrirModalUsuario()">+ Nuevo Usuario</button>
    </div>

    <table class="table-custom">
        <thead>
            <tr>
                <th>Nombre Completo</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Estado</th>
                <th style="width: 120px; text-align: center;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $u): ?>
            <tr>
                <td><?= htmlspecialchars($u['nombre']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td><span class="text-muted"><?= htmlspecialchars($u['rol_nombre'] ?? 'Sin Rol') ?></span></td>
                <td>
                    <span class="badge <?= $u['activo'] == 1 ? 'bg-success' : 'bg-danger' ?>">
                        <?= $u['activo'] == 1 ? 'Activo' : 'Inactivo' ?>
                    </span>
                </td>
                <td style="text-align: center;">
                    <button class="btn-icon" style="color: #f39c12; background:none; border:none; cursor:pointer;"
                        onclick='abrirModalUsuario(<?= json_encode($u) ?>)'>
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn-icon" style="color: #e74c3c; background:none; border:none; cursor:pointer;"
                        onclick="confirmarInactivar(<?= $u['id_usuario'] ?>, '<?= $u['nombre'] ?>')">
                        <i class="fas fa-user-slash"></i>
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="modalUsuario" class="modal-flotante">
    <div class="modal-contenido" style="width: 500px;">
        <div style="background: #f8f9fa; padding: 20px; border-bottom: 1px solid #eee;">
            <h2 id="tituloModalUser" style="margin:0; color: #2c3e50;">Nuevo Usuario</h2>
        </div>
        <form action="/usuarios/guardar" method="POST" style="padding: 25px;">
            <input type="hidden" name="id_usuario" id="user_id">
            <div style="display: flex; flex-direction: column; gap: 15px;">
                <div class="campo-form">
                    <label style="display:block; margin-bottom:5px;">Nombre Completo*</label>
                    <input type="text" name="nombre" id="user_nombre" required
                        style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; box-sizing: border-box;">
                </div>
                <div class="campo-form">
                    <label style="display:block; margin-bottom:5px;">Correo Electrónico*</label>
                    <input type="email" name="email" id="user_email" required
                        style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; box-sizing: border-box;">
                </div>
                <div class="campo-form">
                    <label id="labelPass" style="display:block; margin-bottom:5px;">Contraseña*</label>
                    <input type="password" name="password" id="user_pass"
                        style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; box-sizing: border-box;">
                    <small id="helpPass" style="color:gray; display:none;">Deje en blanco para no cambiar</small>
                </div>
                <div class="campo-form">
                    <label style="display:block; margin-bottom:5px;">Rol Asignado*</label>
                    <select name="id_rol" id="user_rol" required
                        style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
                        <option value="">Seleccione un rol</option>
                        <?php foreach ($roles as $r): ?>
                        <option value="<?= $r['id_rol'] ?>"><?= $r['descripcion'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div style="display:flex; justify-content: flex-end; gap:10px; margin-top:25px;">
                <button type="button" onclick="cerrarModalUser()" class="btn-cancelar">Cancelar</button>
                <button type="submit" class="btn-guardar">Guardar Usuario</button>
            </div>
        </form>
    </div>
</div>

<div id="modalConfirmar" class="modal-flotante">
    <div class="modal-contenido" style="width: 400px; text-align: center; padding: 30px;">
        <div style="color: #e74c3c; font-size: 60px; margin-bottom: 20px;">
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <h2 style="margin: 0 0 10px 0; color: #2c3e50;">¿Estás seguro?</h2>
        <p id="textoConfirmacion" style="color: #7f8c8d; font-size: 16px; margin-bottom: 30px;">
            ¿Deseas inactivar a este usuario?
        </p>
        <div style="display: flex; justify-content: center; gap: 15px;">
            <button onclick="cerrarModalConfirmar()" class="btn-cancelar" style="width: 120px;">Cancelar</button>
            <a id="linkConfirmarAction" href="#" class="btn-eliminar"
                style="width: 120px; text-decoration: none; line-height: 40px;">
                Inactivar
            </a>
        </div>
    </div>
</div>

<script>
function abrirModalUsuario(datos = null) {
    document.getElementById('modalUsuario').style.display = 'flex';
    const passInput = document.getElementById('user_pass');
    if (datos) {
        document.getElementById('tituloModalUser').innerText = 'Editar Usuario';
        document.getElementById('user_id').value = datos.id_usuario;
        document.getElementById('user_nombre').value = datos.nombre;
        document.getElementById('user_email').value = datos.email;
        document.getElementById('user_rol').value = datos.id_rol;
        passInput.required = false;
        document.getElementById('helpPass').style.display = 'block';
        document.getElementById('labelPass').innerText = 'Cambiar Contraseña (Opcional)';
    } else {
        document.getElementById('tituloModalUser').innerText = 'Nuevo Usuario';
        document.getElementById('user_id').value = '';
        document.querySelector('#modalUsuario form').reset();
        passInput.required = true;
        document.getElementById('helpPass').style.display = 'none';
        document.getElementById('labelPass').innerText = 'Contraseña*';
    }
}

function cerrarModalUser() {
    document.getElementById('modalUsuario').style.display = 'none';
}

// FUNCIONES PARA EL MODAL DE CONFIRMACIÓN
function confirmarInactivar(id, nombre) {
    document.getElementById('modalConfirmar').style.display = 'flex';
    document.getElementById('textoConfirmacion').innerHTML =
        `¿Realmente deseas inactivar al usuario <br><strong>${nombre}</strong>?`;
    document.getElementById('linkConfirmarAction').href = `/usuarios/eliminar?id=${id}`;
}

function cerrarModalConfirmar() {
    document.getElementById('modalConfirmar').style.display = 'none';
}

// Cerrar modales si se hace clic fuera del contenido
window.onclick = function(event) {
    if (event.target.className === 'modal-flotante') {
        event.target.style.display = 'none';
    }
}
</script>

<?php include_once '../app/views/layout/footer.php'; ?>