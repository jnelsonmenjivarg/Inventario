<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Comprobante de Venta #<?= $venta['id_venta'] ?></title>
    <style>
    body {
        font-family: Arial, sans-serif;
        width: 300px;
        margin: 0 auto;
        padding: 20px;
    }

    .text-center {
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th {
        border-bottom: 1px solid #000;
        text-align: left;
    }

    .total {
        font-weight: bold;
        font-size: 1.2em;
        text-align: right;
    }

    @media print {
        .no-print {
            display: none;
        }
    }
    </style>
</head>

<body onload="window.print();">

    <div class="text-center">
        <h3>INVENTARIO G1</h3>
        <p>Sucursal: <?= $venta['sucursal_nombre'] ?><br>
            Fecha: <?= $venta['fecha_venta'] ?></p>
    </div>

    <p><strong>Cliente:</strong> <?= $venta['cliente_nombre'] ?><br>
        <strong>Ticket:</strong> #<?= $venta['id_venta'] ?>
    </p>

    <table>
        <thead>
            <tr>
                <th>Cant.</th>
                <th>Producto</th>
                <th>Subt.</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($detalle as $item): ?>
            <tr>
                <td><?= $item['cantidad'] ?></td>
                <td><?= $item['producto_nombre'] ?></td>
                <td>$<?= number_format($item['cantidad'] * $item['precio_unitario'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p class="total">TOTAL: $<?= number_format($venta['monto_total'], 2) ?></p>

    <div class="text-center no-print" style="margin-top: 20px;">
        <button onclick="window.close();">Cerrar Ventana</button>
    </div>

</body>

</html>