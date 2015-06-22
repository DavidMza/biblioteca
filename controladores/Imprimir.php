<?php
// Rutas donde tendremos la libreria y el fichero de idiomas.
require_once('../recursos/tcpdf/tcpdf_import.php');
$htmlImprimir = $_POST['html'];

// Crear el documento
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
 
// Contenido de la cabecera
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Sistema Integral", "Sistema de Administracion de ".$_POST['Formulario']);

// Fuente de la cabecera y el pie de página
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
// Márgenes
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// Saltos de página automáticos.
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
// Establecer la fuente
$pdf->SetFont('times', 'BI', 16);
 
// Añadir página
$pdf->AddPage();
 
// Escribir una línea con el método CELL
$pdf->writeHTML($htmlImprimir, true, false, true, false, '');
 
// ---------------------------------------------------------
 
//Cerramos y damos salida al fichero PDF
$pdf->Output('reporte.pdf', 'I');