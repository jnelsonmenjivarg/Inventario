<?php require "views/layout/header.php"; ?>
<?php require "views/layout/sidebar.php"; ?>

<div class="container-view">
    <div class="card">
        <h2 class="title">👤 Detalles del Usuario</h2>

        <div class="info">
            <p><strong>ID:</strong> <?= $usuario['id_usuario'] ?></p>
            <p><strong>Nombre:</strong> <?= htmlspecialchars($usuario['nombre']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($usuario['email']) ?></p>
            <p><strong>Rol:</strong> <?= htmlspecialchars($usuario['rol']) ?></p>
        </div>

        <div class="actions">
            <a href="/usuarios/editar/<?= $usuario['id_usuario'] ?>" class="btn btn-primary">✏️ Editar</a>
            <a href="/usuarios" class="btn btn-secondary">🔙 Volver</a>
        </div>
    </div>
</div>

<?php require "views/layout/footer.php"; ?>

<style>
.container-view {
    width: 100%;
    display: flex;
    justify-content: center;
    margin-top: 40px;
}

.card {
    width: 450px;
    padding: 30px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.title {
    margin-bottom: 25px;
    text-align: center;
}

.info p {
    font-size: 18px;
    margin-bottom: 12px;
}

.actions {
    margin-top: 25px;
    display: flex;
    gap: 15px;
    justify-content: center;
}
</style>
