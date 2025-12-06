<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content">
    <h2>Editar Rol</h2>

    <form method="POST">
        <label>Descripción del rol:</label>
        <input type="text" name="descripcion" class="input" value="<?= $rol['descripcion'] ?>" required>

        <button class="btn-save">Actualizar</button>
    </form>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>