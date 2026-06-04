<aside class="sidebar">
    <div style="padding: 25px 20px; background: #1a252f; text-align: center; border-bottom: 1px solid #34495e;">
        <h2 style="color: white; margin: 0; font-size: 1.2rem;">📊 INVENTARIO G1</h2>
    </div>

    <nav style="flex: 1; overflow-y: auto;">
        <ul style="list-style: none; padding: 0; margin: 0;">
            <li onclick="location.href='/inventario'"
                style="padding: 15px 25px; color: #ecf0f1; cursor: pointer; border-bottom: 1px solid #34495e;">
                <i class="fas fa-home" style="width: 25px;"></i> Inventario General
            </li>

            <?php 
            $rol = strtolower($_SESSION['rol'] ?? 'sin rol');
            
            // --- REGLA PARA ADMINISTRADOR: VE TODO EL MENÚ ---
            if ($rol == 'admin' || $rol == 'administrador'): ?>

            <li onclick="location.href='/usuarios'"
                style="padding: 13px 25px; color: #ecf0f1; cursor: pointer; border-bottom: 1px solid #34495e;">
                <i class="fas fa-users" style="width: 25px;"></i> Usuarios
            </li>
            <li onclick="location.href='/roles'"
                style="padding: 13px 25px; color: #ecf0f1; cursor: pointer; border-bottom: 1px solid #34495e;">
                <i class="fas fa-user-tag" style="width: 25px;"></i> Roles
            </li>
            <li onclick="location.href='/opciones'"
                style="padding: 13px 25px; color: #ecf0f1; cursor: pointer; border-bottom: 1px solid #34495e;">
                <i class="fas fa-list-ul" style="width: 25px;"></i> Opciones
            </li>
            <li onclick="location.href='/permisos'"
                style="padding: 13px 25px; color: #ecf0f1; cursor: pointer; border-bottom: 1px solid #34495e;">
                <i class="fas fa-shield-alt" style="width: 25px;"></i> Permisos
            </li>
            <li onclick="location.href='/proveedores'"
                style="padding: 13px 25px; color: #ecf0f1; cursor: pointer; border-bottom: 1px solid #34495e;">
                <i class="fas fa-truck" style="width: 25px;"></i> Proveedores
            </li>
            <li onclick="location.href='/clientes'"
                style="padding: 13px 25px; color: #ecf0f1; cursor: pointer; border-bottom: 1px solid #34495e;">
                <i class="fas fa-user-friends" style="width: 25px;"></i> Clientes
            </li>
            <li onclick="location.href='/ventas'"
                style="padding: 13px 25px; color: #ecf0f1; cursor: pointer; border-bottom: 1px solid #34495e;">
                <i class="fas fa-shopping-cart" style="width: 25px;"></i> Ventas
            </li>
            <li onclick="location.href='/ubicaciones'"
                style="padding: 13px 25px; color: #ecf0f1; cursor: pointer; border-bottom: 1px solid #34495e;">
                <i class="fas fa-map-marked-alt" style="width: 25px;"></i> Ubicaciones
            </li>
            <li onclick="location.href='/sucursales'"
                style="padding: 13px 25px; color: #ecf0f1; cursor: pointer; border-bottom: 1px solid #34495e;">
                <i class="fas fa-store" style="width: 25px;"></i> Sucursales
            </li>
            <li onclick="location.href='/productos'"
                style="padding: 13px 25px; color: #ecf0f1; cursor: pointer; border-bottom: 1px solid #34495e;">
                <i class="fas fa-boxes" style="width: 25px;"></i> Productos
            </li>

            <?php else: ?>
            <?php if(!empty($_SESSION['menu'])): ?>
            <?php foreach($_SESSION['menu'] as $opcion): ?>
            <li onclick="location.href='<?= $opcion['url'] ?>'"
                style="padding: 15px 25px; color: #ecf0f1; cursor: pointer; border-bottom: 1px solid #34495e;">
                <i class="<?= $opcion['icono'] ?>" style="width: 25px;"></i> <?= $opcion['descripcion'] ?>
            </li>
            <?php endforeach; ?>
            <?php else: ?>
            <li style="padding: 25px; color: #e67e22; font-size: 0.85rem; text-align: center; line-height: 1.4;">
                <i class="fas fa-lock fa-2x" style="margin-bottom: 10px;"></i><br>
                Acceso restringido.<br>Solicite permisos al administrador.
            </li>
            <?php endif; ?>
            <?php endif; ?>
        </ul>
    </nav>

    <div style="padding: 15px 20px; background: #1a252f; border-top: 2px solid #27ae60;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <i class="fas fa-user-circle fa-2x" style="color: #27ae60;"></i>
            <div style="color: white; overflow: hidden;">
                <strong
                    style="font-size: 0.9rem; display: block; white-space: nowrap; text-overflow: ellipsis;"><?= $_SESSION['nombre'] ?></strong>
                <span style="font-size: 0.7rem; color: #bdc3c7;"><?= ucfirst($rol) ?></span>
            </div>
        </div>
        <div onclick="location.href='/logout'"
            style="margin-top: 10px; padding-top: 10px; border-top: 1px solid #34495e; color: #e74c3c; cursor: pointer; font-size: 0.85rem; font-weight: bold;">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </div>
    </div>
</aside>