<?php include_once '../app/views/layout/header.php'; ?>

<div class="container-blanco">
    <div class="header-seccion" style="display: flex; justify-content: space-between; align-items: center;">
        <h2><i class="fas fa-store"></i> Sucursales</h2>
        <button class="btn-guardar-pro" onclick="abrirModalSucursal()">+ Nueva Sucursal</button>
    </div>
    <hr>

    <table class="tabla-personalizada" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                <th style="padding: 12px; text-align: left;">Nombre</th>
                <th style="padding: 12px; text-align: left;">Teléfono</th>
                <th style="padding: 12px; text-align: left;">Dirección</th>
                <th style="padding: 12px; text-align: center;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($sucursales as $s): ?>
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 12px;"><?= $s['nombre'] ?></td>
                <td style="padding: 12px;"><?= $s['telefono'] ?></td>
                <td style="padding: 12px;"><?= $s['direccion'] ?></td>
                <td style="padding: 12px; text-align: center;">
                    <button onclick='editarSucursal(<?= json_encode($s) ?>)' style="background: none; border: none; color: #3498db; cursor: pointer;"><i class="fas fa-edit"></i></button>
                    <button onclick="eliminarSucursal(<?= $s['id_sucursal'] ?>)" style="background: none; border: none; color: #e74c3c; cursor: pointer; margin-left: 10px;"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="modalSucursal" class="modal-flotante" style="display:none; align-items:center; justify-content:center; background:rgba(0,0,0,0.5); position:fixed; top:0; left:0; width:100%; height:100%; z-index:9999;">
    <div class="modal-contenido" style="background:white; padding:25px; border-radius:10px; width:450px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
        <h3 id="modalTitulo">Nueva Sucursal</h3>
        <form action="/sucursales/guardar" method="POST" id="formSucursal">
            <input type="hidden" name="id_sucursal" id="id_sucursal">
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Nombre Sucursal:</label>
                <input type="text" name="nombre" id="nombre_suc" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Teléfono:</label>
                <input type="text" name="telefono" id="tele_suc" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px;">Dirección:</label>
                <textarea name="direccion" id="dir_suc" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; height: 80px;"></textarea>
            </div>

            <div style="display: flex; gap: 10px; justify-content: flex-end;">
                <button type="button" class="btn-cancelar-pro" onclick="cerrarModalSucursal()">Cancelar</button>
                <button type="submit" class="btn-guardar-pro">Guardar Sucursal</button>
            </div>
        </form>
    </div>
</div>

<script>
function abrirModalSucursal() {
    document.getElementById('modalTitulo').innerText = 'Nueva Sucursal';
    document.getElementById('formSucursal').reset();
    document.getElementById('id_sucursal').value = '';
    document.getElementById('modalSucursal').style.display = 'flex';
}

function editarSucursal(data) {
    document.getElementById('modalTitulo').innerText = 'Editar Sucursal';
    document.getElementById('id_sucursal').value = data.id_sucursal;
    document.getElementById('nombre_suc').value = data.nombre;
    document.getElementById('tele_suc').value = data.telefono;
    document.getElementById('dir_suc').value = data.direccion;
    document.getElementById('modalSucursal').style.display = 'flex';
}

function cerrarModalSucursal() {
    document.getElementById('modalSucursal').style.display = 'none';
}

function eliminarSucursal(id) {
    if(confirm("¿Estás seguro de eliminar esta sucursal? Esto podría afectar el inventario asociado.")) {
        window.location.href = "/sucursales/eliminar?id=" + id;
    }
}
</script>