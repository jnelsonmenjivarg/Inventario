<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content">
    <h2>Crear Rol</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <label>Descripción del rol:</label>
        <input type="text" name="descripcion" class="input" required>

        <button class="btn-save">Guardar</button>
    </form>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
