<?php include_once '../app/views/layout/header.php'; ?>

<div class="container-blanco">
    <div class="header-seccion">
        <h2><i class="fas fa-map-marked-alt"></i> Mantenimiento de Ubicaciones</h2>
    </div>
    <hr>

    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-top: 20px;">

        <div style="display: flex; flex-direction: column; gap: 10px;">
            <label><strong>1. Departamentos</strong></label>
            <div class="lista-custom"
                style="height: 350px; border: 1px solid #ccc; overflow-y: auto; border-radius: 5px;">
                <?php foreach($departamentos as $d): ?>
                <div class="item-lista"
                    style="padding: 8px; border-bottom: 1px solid #eee; display: flex; align-items: center; gap: 10px;">
                    <input type="checkbox" class="chk-depto" name="chk_depto" value="<?= $d['id_departamento'] ?>"
                        onclick="gestionarSeleccionDepto(this, '<?= $d['descripcion'] ?>')">
                    <span><?= $d['descripcion'] ?></span>
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
                        style="color: #3498db;">---</span></strong></label>
            <div id="container-muni" class="lista-custom"
                style="height: 350px; border: 1px solid #ccc; overflow-y: auto; background: #f9f9f9;">
                <div style="padding: 20px; color: #999; text-align: center;">Marque un departamento</div>
            </div>
            <div style="display: flex; gap: 5px;">
                <button class="btn-nuevo" id="btn-add-muni" onclick="abrirModal('Muni')" disabled
                    style="flex:1; opacity: 0.5;"><i class="fas fa-plus"></i></button>
                <button class="btn-cancelar-pro" id="btn-del-muni" onclick="eliminar('Muni')" disabled
                    style="flex:1; background:#e74c3c; opacity: 0.5;"><i class="fas fa-trash"></i></button>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 10px;">
            <label><strong>3. Distritos de: <span id="label-muni-sel"
                        style="color: #3498db;">---</span></strong></label>
            <div id="container-dist" class="lista-custom"
                style="height: 350px; border: 1px solid #ccc; overflow-y: auto; background: #f9f9f9;">
                <div style="padding: 20px; color: #999; text-align: center;">Marque un municipio</div>
            </div>
            <div style="display: flex; gap: 5px;">
                <button class="btn-nuevo" id="btn-add-dist" onclick="abrirModal('Dist')" disabled
                    style="flex:1; opacity: 0.5;"><i class="fas fa-plus"></i></button>
                <button class="btn-cancelar-pro" id="btn-del-dist" onclick="eliminar('Dist')" disabled
                    style="flex:1; background:#e74c3c; opacity: 0.5;"><i class="fas fa-trash"></i></button>
            </div>
        </div>
    </div>
</div>

<script>
let deptoSeleccionado = null;
let muniSeleccionado = null;

// Unificamos a la función que pide el HTML: gestionarSeleccionDepto
function gestionarSeleccionDepto(check, descripcion) {
    // 1. Desmarcar otros checkboxes de la lista de Deptos
    document.querySelectorAll('.chk-depto').forEach(c => {
        if (c !== check) {
            c.checked = false;
            c.parentElement.style.background = "white"; // Limpiar color de los no seleccionados
        }
    });

    if (check.checked) {
        deptoSeleccionado = check.value;
        check.parentElement.style.background = "#e1f5fe"; // Color de selección
        document.getElementById('label-depto-sel').innerText = nombre;

        // Activar botón de agregar municipio
        const btnMuni = document.getElementById('btn-add-muni');
        btnMuni.disabled = false;
        btnMuni.style.opacity = "1";

        cargarMunicipios(deptoSeleccionado);
    } else {
        check.parentElement.style.background = "white";
        resetearMuncipios();
    }
}

function cargarMunicipios(id) {
    const container = document.getElementById('container-muni');
    container.innerHTML =
        '<div style="padding:20px; text-align:center;"><i class="fas fa-spinner fa-spin"></i> Cargando...</div>';

    fetch('/ubicaciones/getMunicipios?id=' + id)
        .then(res => res.json())
        .then(data => {
            container.innerHTML = '';
            if (data.length === 0) {
                container.innerHTML =
                    '<div style="padding:20px; color:#999; text-align:center;">No hay municipios registrados</div>';
                return;
            }
            data.forEach(m => {
                container.innerHTML += `
                    <div class="item-lista" style="padding: 8px; border-bottom: 1px solid #eee; display: flex; align-items: center; gap: 10px;">
                        <input type="checkbox" class="chk-muni" onclick="gestionarSeleccionMuni(this, '${m.descripcion}')" value="${m.id_municipio}">
                        <span>${m.descripcion}</span>
                    </div>`;
            });
        });
}

function gestionarSeleccionMuni(check, descripcion) {
    // Desmarcar otros municipios
    document.querySelectorAll('.chk-muni').forEach(c => {
        if (c !== check) {
            c.checked = false;
            c.parentElement.style.background = "transparent";
        }
    });

    if (check.checked) {
        muniSeleccionado = check.value;
        check.parentElement.style.background = "#e8f5e9"; // Color verde suave para municipios
        document.getElementById('label-muni-sel').innerText = nombre;

        // Activar botón de agregar distrito
        const btnDist = document.getElementById('btn-add-dist');
        btnDist.disabled = false;
        btnDist.style.opacity = "1";

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
            if (data.length === 0) {
                container.innerHTML =
                    '<div style="padding:20px; color:#999; text-align:center;">No hay distritos</div>';
                return;
            }
            container.innerHTML = data.map(d => `
                <div style="padding: 10px; border-bottom: 1px solid #eee; display: flex; align-items: center; gap: 10px;">
                    <input type="checkbox" class="chk-dist" value="${d.id_distrito}"> 
                    <span>${d.descripcion}</span>
                </div>
            `).join('');
        });
}

function resetearMuncipios() {
    deptoSeleccionado = null;
    document.getElementById('label-depto-sel').innerText = "---";
    document.getElementById('container-muni').innerHTML =
        '<div style="padding: 20px; color: #999; text-align: center;">Marque un departamento</div>';
    document.getElementById('btn-add-muni').disabled = true;
    document.getElementById('btn-add-muni').style.opacity = "0.5";
    resetearDistritos();
}

function resetearDistritos() {
    muniSeleccionado = null;
    document.getElementById('label-muni-sel').innerText = "---";
    document.getElementById('container-dist').innerHTML =
        '<div style="padding: 20px; color: #999; text-align: center;">Marque un municipio</div>';
    document.getElementById('btn-add-dist').disabled = true;
    document.getElementById('btn-add-dist').style.opacity = "0.5";
}

function abrirModal(tipo) {
    const modal = document.getElementById('modalUbicacion');
    // Si no tienes el modal en este archivo, recuerda que debes incluirlo o tenerlo en un partial
    if (!modal) {
        alert("Error: El modal no se encuentra en el DOM");
        return;
    }

    document.getElementById('modalTitulo').innerText = 'Nuevo ' + tipo;
    const form = document.getElementById('formUbicacion');

    if (tipo === 'Depto') form.action = '/ubicaciones/guardarDepto';
    if (tipo === 'Muni') {
        if (!deptoSeleccionado) return alert("Seleccione un departamento");
        form.action = '/ubicaciones/guardarMuni';
        document.getElementById('hidden_depto').value = deptoSeleccionado;
    }
    if (tipo === 'Dist') {
        if (!muniSeleccionado) return alert("Seleccione un municipio");
        form.action = '/ubicaciones/guardarDist';
        document.getElementById('hidden_muni').value = muniSeleccionado;
        // Referencia al depto para recargar la página correctamente si usas el refresh
        if (document.getElementById('hidden_depto_ref')) {
            document.getElementById('hidden_depto_ref').value = deptoSeleccionado;
        }
    }
    modal.style.display = 'flex';
}

function cerrarModal() {
    document.getElementById('modalUbicacion').style.display = 'none';
}
</script>