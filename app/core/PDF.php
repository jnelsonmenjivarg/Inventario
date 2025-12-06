<?php

use Dompdf\Dompdf;
use Dompdf\Options;

class PDF
{
    public static function generar($html, $nombre = "reporte.pdf")
    {
        $options = new Options();
        $options->set('defaultFont', 'Helvetica');

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream($nombre, ["Attachment" => false]);
    }
}
