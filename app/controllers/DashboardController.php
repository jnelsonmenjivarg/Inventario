<?php 

class DashboardController {
    
    public function index()
    {
        
        Auth::requireLogin();
        
        $usuario = Auth::user();
        $rol = $usuario['id_rol'];

        $db = $GLOBALS['db'];

        // === Estadísticas generales (ADMIN) ===
        $stats = [
            'total_productos' => $db->query("SELECT COUNT(*) FROM productos")->fetchColumn(),
            'total_clientes'  => $db->query("SELECT COUNT(*) FROM clientes")->fetchColumn(),
            'total_usuarios'  => $db->query("SELECT COUNT(*) FROM usuarios")->fetchColumn(),
            'ventas_hoy'      => $db->query("SELECT IFNULL(SUM(monto_total),0) FROM ventas WHERE DATE(fecha_venta)=CURDATE()")->fetchColumn(),
        ];

        // Últimas ventas
        $ultimas_ventas = $db->query("
            SELECT v.id_venta, c.nombres, c.apellidos, v.fecha_venta, v.monto_total
            FROM ventas v
            INNER JOIN clientes c ON c.id_cliente = v.id_cliente
            ORDER BY v.id_venta DESC
            LIMIT 5
        ")->fetchAll();

        // Stock crítico
        $stock_critico = $db->query("
            SELECT 
                p.descripcion_corta,
                i.cantidad_actual,
                i.cantidad_minima_alerta
            FROM inventario i
            INNER JOIN productos p ON p.id_producto = i.id_producto
            WHERE i.cantidad_actual < i.cantidad_minima_alerta
            ORDER BY i.cantidad_actual ASC
            LIMIT 10
        ")->fetchAll();


        require __DIR__ . '/../views/dashboard/index.php';
    }
}