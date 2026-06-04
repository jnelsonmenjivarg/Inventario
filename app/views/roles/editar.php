<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<?php var_dump($rol); ?>
<?php if (!isset($rol) || !$rol) { die("Rol no encontrado."); } ?>

<div class="content">
    <h2>Editar Rol</h2>

    <form method="POST">
        <label>Descripción del rol:</label>
        <input type="text" name="descripcion"
            value="<?= isset($rol['descripcion']) ? htmlspecialchars($rol['descripcion']) : '' ?>" required>


        <button class="btn-save">Actualizar</button>
    </form>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>