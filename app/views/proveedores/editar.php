<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content">

    <h2>Editar Proveedor</h2>

    <form method="POST" action="/proveedores/editar?id=<?= $proveedor['id_proveedor'] ?>">

        <label>Descripción corta</label>
        <input type="text" name="descripcion_corta"
               value="<?= $proveedor['descripcion_corta'] ?>" required>

        <label>Descripción larga</label>
        <textarea name="descripcion_larga"><?= $proveedor['descripcion_larga'] ?></textarea>

        <label>País de origen</label>
        <input type="text" name="pais_origen" value="<?= $proveedor['pais_origen'] ?>">

        <label>ID Tributario / NIT</label>
        <input type="text" name="id_tributario" value="<?= $proveedor['id_tributario'] ?>" required>

        <label>Representante legal</label>
        <input type="text" name="representante_legal" value="<?= $proveedor['representante_legal'] ?>">

        <label>Correo proveedor</label>
        <input type="email" name="correo_proveedor" value="<?= $proveedor['correo_proveedor'] ?>" required>

        <button class="btn-save">Actualizar</button>
    </form>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
