<?php include_once '../app/views/layout/header.php'; ?>

<div class="container-blanco">
    <div class="header-seccion">
        <h2><i class="fas fa-map-marked-alt"></i> Mantenimiento de Ubicaciones</h2>
    </div>
    <hr>

    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-top: 20px; align-items: start;">

        <div style="display: flex; flex-direction: column; gap: 10px;">
            <label><strong>1. Departamentos</strong></label>
            <div class="lista-custom"
                style="height: 350px; border: 1px solid #ccc; overflow-y: auto; background: white; border-radius: 5px;">
                <?php foreach($departamentos as $d): ?>
                <div class="item-lista"
                    style="padding: 10px; border-bottom: 1px solid #eee; display: flex; align-items: center; gap: 10px;">
                    <input type="checkbox" class="chk-depto" value="<?= $d['id_departamento'] ?>"
                        style="width: 18px; height: 18px; cursor: pointer;"
                        onclick="gestionarSeleccionDepto(this, '<?= $d['descripcion'] ?>')">
                    <span style="font-size: 14px;"><?= $d['descripcion'] ?></span>
                </div>
                <?php endforeach; ?>
            </div>
            <div style="display: flex; gap: 5px;">
                <button class="btn-nuevo" onclick="abrirModal('Depto')" style="flex:1;"><i
                        class="fas fa-plus"></i></button>
                <button class="btn-cancelar-pro" onclick="eliminar('Depto')" style="flex:1; background:#e74c3c;"><i
                        class="fas fa-trash"></i></button>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 10px;">
            <label><strong>2. Municipios de: <span id="label-depto-sel"
                        style="color:#3498db;">---</span></strong></label>
            <div id="container-muni"
                style="height: 350px; border: 1px solid #ccc; overflow-y: auto; background: #f9f9f9; border-radius: 5px;">
                <div style="padding: 20px; color: #999; text-align: center;">Seleccione un departamento</div>
            </div>
            <div style="display: flex; gap: 5px;">
                <button class="btn-nuevo" id="btn-add-muni" onclick="abrirModal('Muni')" disabled
                    style="flex:1; opacity:0.5;"><i class="fas fa-plus"></i></button>
                <button class="btn-cancelar-pro" id="btn-del-muni" onclick="eliminar('Muni')" disabled
                    style="flex:1; background:#e74c3c; opacity:0.5;"><i class="fas fa-trash"></i></button>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 10px;">
            <label><strong>3. Distritos de: <span id="label-muni-sel" style="color:#3498db;">---</span></strong></label>
            <div id="container-dist"
                style="height: 350px; border: 1px solid #ccc; overflow-y: auto; background: #f9f9f9; border-radius: 5px;">
                <div style="padding: 20px; color: #999; text-align: center;">Seleccione un municipio</div>
            </div>
            <div style="display: flex; gap: 5px;">
                <button class="btn-nuevo" id="btn-add-dist" onclick="abrirModal('Dist')" disabled
                    style="flex:1; opacity:0.5;"><i class="fas fa-plus"></i></button>
                <button class="btn-cancelar-pro" id="btn-del-dist" onclick="eliminar('Dist')" disabled
                    style="flex:1; background:#e74c3c; opacity:0.5;"><i class="fas fa-trash"></i></button>
            </div>
        </div>

    </div>
</div>

<div id="modalUbicacion" class="modal-flotante"
    style="display:none; align-items:center; justify-content:center; background:rgba(0,0,0,0.5); position:fixed; top:0; left:0; width:100%; height:100%; z-index:9999;">
    <div class="modal-contenido" style="background:white; padding:20px; border-radius:10px; width:400px;">
        <h3 id="modalTitulo">Nuevo</h3>
        <form id="formUbicacion" method="POST">
            <input type="hidden" name="id_departamento" id="hidden_depto">
            <input type="hidden" name="id_municipio" id="hidden_muni">
            <input type="hidden" name="id_departamento_ref" id="hidden_depto_ref">
            <div style="margin-bottom:15px;">
                <label>Descripción:</label>
                <input type="text" name="descripcion" id="input_desc" required style="width:100%; padding:8px;">
            </div>
            <div style="text-align:right;">
                <button type="button" class="btn-cancelar-pro" onclick="cerrarModal()">Cancelar</button>
                <button type="submit" class="btn-guardar-pro">Guardar</button>
            </div>
        </form>
    </div>
</div>

<script>
let deptoSeleccionado = null;
let muniSeleccionado = null;

function gestionarSeleccionDepto(check, descripcion) {
    document.querySelectorAll('.chk-depto').forEach(c => {
        if (c !== check) {
            c.checked = false;
            c.parentElement.style.background = "white";
        }
    });

    if (check.checked) {
        deptoSeleccionado = check.value;
        check.parentElement.style.background = "#e1f5fe";
        document.getElementById('label-depto-sel').innerText = descripcion;
        document.getElementById('btn-add-muni').disabled = false;
        document.getElementById('btn-add-muni').style.opacity = "1";
        cargarMunicipios(deptoSeleccionado);
    } else {
        check.parentElement.style.background = "white";
        resetearMunicipios();
    }
}

function cargarMunicipios(id) {
    const container = document.getElementById('container-muni');
    container.innerHTML = '<div style="padding:20px; text-align:center;">Cargando...</div>';
    fetch('/ubicaciones/getMunicipios?id=' + id)
        .then(res => res.json())
        .then(data => {
            container.innerHTML = data.map(m => `
                <div style="padding:8px; border-bottom:1px solid #eee; display:flex; align-items:center; gap:10px;">
                    <input type="checkbox" class="chk-muni" onclick="gestionarSeleccionMuni(this, '${m.descripcion}')" value="${m.id_municipio}">
                    <span>${m.descripcion}</span>
                </div>
            `).join('') || '<div style="padding:20px; text-align:center;">No hay municipios</div>';
        });
}

function gestionarSeleccionMuni(check, descripcion) {
    document.querySelectorAll('.chk-muni').forEach(c => {
        if (c !== check) {
            c.checked = false;
            c.parentElement.style.background = "transparent";
        }
    });
    if (check.checked) {
        muniSeleccionado = check.value;
        check.parentElement.style.background = "#e8f5e9";
        document.getElementById('label-muni-sel').innerText = descripcion;
        document.getElementById('btn-add-dist').disabled = false;
        document.getElementById('btn-add-dist').style.opacity = "1";
        cargarDistritos(muniSeleccionado);
    } else {
        check.parentElement.style.background = "transparent";
        resetearDistritos();
    }
}

function cargarDistritos(id) {
    const container = document.getElementById('container-dist');
    fetch('/ubicaciones/getDistritos?id=' + id)
        .then(res => res.json())
        .then(data => {
            container.innerHTML = data.map(d => `
                <div style="padding:8px; border-bottom:1px solid #eee; display:flex; align-items:center; gap:10px;">
                    <input type="checkbox" value="${d.id_distrito}">
                    <span>${d.descripcion}</span>
                </div>
            `).join('') || '<div style="padding:20px; text-align:center;">No hay distritos</div>';
        });
}

function resetearMunicipios() {
    deptoSeleccionado = null;
    document.getElementById('label-depto-sel').innerText = "---";
    document.getElementById('container-muni').innerHTML =
        '<div style="padding:20px; color:#999; text-align:center;">Seleccione un departamento</div>';
    document.getElementById('btn-add-muni').disabled = true;
    document.getElementById('btn-add-muni').style.opacity = "0.5";
    resetearDistritos();
}

function resetearDistritos() {
    muniSeleccionado = null;
    document.getElementById('label-muni-sel').innerText = "---";
    document.getElementById('container-dist').innerHTML =
        '<div style="padding:20px; color:#999; text-align:center;">Seleccione un municipio</div>';
    document.getElementById('btn-add-dist').disabled = true;
    document.getElementById('btn-add-dist').style.opacity = "0.5";
}

function abrirModal(tipo) {
    const modal = document.getElementById('modalUbicacion');
    const form = document.getElementById('formUbicacion');
    document.getElementById('modalTitulo').innerText = 'Nuevo ' + tipo;
    if (tipo === 'Depto') form.action = '/ubicaciones/guardarDepto';
    if (tipo === 'Muni') {
        form.action = '/ubicaciones/guardarMuni';
        document.getElementById('hidden_depto').value = deptoSeleccionado;
    }
    if (tipo === 'Dist') {
        form.action = '/ubicaciones/guardarDist';
        document.getElementById('hidden_muni').value = muniSeleccionado;
        document.getElementById('hidden_depto_ref').value = deptoSeleccionado;
    }
    modal.style.display = 'flex';
}

function cerrarModal() {
    document.getElementById('modalUbicacion').style.display = 'none';
}
</script>