<?php

require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/Helpers.php';
require_once __DIR__ . '/../core/PDF.php';
require_once __DIR__ . '/../models/Compra.php';
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Venta.php';

class ReportesController
{
    public function compras()
    {
        Auth::requireLogin();

        $compra = new Compra();
        $compras = $compra->all();

        ob_start();
        require __DIR__ . '/../reports/compras.php';
        $html = ob_get_clean();

        PDF::generar($html, "reporte_compras.pdf");
    }

    public function existencias()
    {
        Auth::requireLogin();

        $producto = new Producto();
        $existencias = $producto->stockGeneral();

        ob_start();
        require __DIR__ . '/../reports/existencias.php';
        $html = ob_get_clean();

        PDF::generar($html, "existencias.pdf");
    }

    public function ventas()
    {
        Auth::requireLogin();

        $venta = new Venta();
        $ventas = $venta->all();

        ob_start();
        require __DIR__ . '/../reports/ventas.php';
        $html = ob_get_clean();

        PDF::generar($html, "ventas.pdf");
    }

    public function stock()
    {
        Auth::requireLogin();

        $producto = new Producto();
        $productos = $producto->all();

        ob_start();
        require __DIR__ . '/../reports/productos_stock.php';
        $html = ob_get_clean();

        PDF::generar($html, "productos_stock.pdf");
    }

    public function mensual()
    {
        Auth::requireLogin();

        $venta = new Venta();
        $compra = new Compra();

        $ventasMensuales = $venta->totalesMensuales();
        $comprasMensuales = $compra->totalesMensuales();

        ob_start();
        require __DIR__ . '/../reports/ventas_compras_mensual.php';
        $html = ob_get_clean();

        PDF::generar($html, "ventas_compras_mensuales.pdf");
    }
}
