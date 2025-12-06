<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content">

    <h2>Nuevo Proveedor</h2>

    <form method="POST" action="/proveedores/crear">

        <label>Descripción corta</label>
        <input type="text" name="descripcion_corta" required>

        <label>Descripción larga</label>
        <textarea name="descripcion_larga"></textarea>

        <label>País de origen</label>
        <input type="text" name="pais_origen">

        <label>ID Tributario / NIT</label>
        <input type="text" name="id_tributario" required>

        <label>Representante legal</label>
        <input type="text" name="representante_legal">

        <label>Correo proveedor</label>
        <input type="email" name="correo_proveedor" required>

        <button class="btn-save">Guardar</button>
    </form>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
