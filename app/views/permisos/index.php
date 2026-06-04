<?php 
$seccion_activa = true; 
include_once '../app/views/layout/header.php'; 
?>

<div class="container-blanco">
    <div class="header-seccion">
        <h2>🛡️ Asignación de Permisos (Rol - Opción)</h2>
    </div>

    <div style="display: grid; grid-template-columns: 300px 1fr; gap: 30px;">
        <div style="border-right: 1px solid #eee; padding-right: 20px;">
            <h3 style="font-size: 1rem; color: #7f8c8d;">1. Seleccione un Rol</h3>
            <ul style="list-style: none; padding: 0;">
                <?php foreach ($roles as $r): ?>
                    <li style="margin-bottom: 10px;">
                        <a href="/permisos?id_rol=<?= $r['id_rol'] ?>" 
                           style="display: block; padding: 12px; border-radius: 8px; text-decoration: none; 
                                  background: <?= ($id_rol == $r['id_rol']) ? '#3498db' : '#f8f9fa' ?>;
                                  color: <?= ($id_rol == $r['id_rol']) ? 'white' : '#2c3e50' ?>;
                                  font-weight: bold; transition: 0.3s;">
                            <i class="fas fa-user-tag"></i> <?= htmlspecialchars($r['descripcion']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div>
            <?php if ($id_rol): ?>
                <h3 style="font-size: 1rem; color: #7f8c8d;">2. Marque las Opciones Permitidas</h3>
                <form action="/permisos/guardar" method="POST">
                    <input type="hidden" name="id_rol" value="<?= $id_rol ?>">
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 20px;">
                        <?php foreach ($opciones as $o): ?>
                            <label style="display: flex; align-items: center; gap: 10px; padding: 15px; 
                                          background: #fff; border: 1px solid #ddd; border-radius: 8px; cursor: pointer;">
                                <input type="checkbox" name="opciones[]" value="<?= $o['id_opcion'] ?>"
                                    <?= in_array($o['id_opcion'], $permisosActuales) ? 'checked' : '' ?>
                                    style="width: 20px; height: 20px;">
                                <div>
                                    <strong style="display: block;"><?= htmlspecialchars($o['descripcion']) ?></strong>
                                    <small style="color: <?= $o['b_activa'] ? 'green' : 'red' ?>;">
                                        <?= $o['b_activa'] ? 'Sistema Activo' : 'Inactiva' ?>
                                    </small>
                                </div>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <div style="margin-top: 30px; text-align: right;">
                        <button type="submit" class="btn-guardar-pro" style="padding: 15px 40px;">
                            <i class="fas fa-save"></i> Actualizar Permisos
                        </button>
                    </div>
                </form>
            <?php else: ?>
                <div style="text-align: center; padding: 50px; color: #95a5a6;">
                    <i class="fas fa-arrow-left" style="font-size: 3rem; margin-bottom: 20px;"></i>
                    <p>Seleccione un rol de la izquierda para gestionar sus permisos.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include_once '../app/views/layout/footer.php'; ?>