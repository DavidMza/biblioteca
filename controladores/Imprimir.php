<?php
//ob_end_clean();
// Rutas donde tendremos la libreria y el fichero de idiomas.
require_once('../recursos/tcpdf/tcpdf.php');
$htmlImprimir = $_POST['html'];
 //$htmlImprimir = '<table border="1" align="center"><tr><td bgcolor="#0076D0" color="white"><h3>Denominacion</h3></td></tr><tr><td>Lenguaje Adulto</td></tr><tr bgcolor="#A5D4F9"><td>Violencia</td></tr></table>';
 $formulario = $_POST['Formulario'];
 //$formulario = 'Caracteristicas';
 //$logo = '../imagenes/logo_biblioteca.png';
 
// Crear el documento
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
 
// Contenido de la cabecera
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING.$formulario);//"Sistema Integral"

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

$pdf->writeHTML('<table align="center"><tr><td><h1>Listado de '.$formulario.'</h1></td></tr></table>');

// Escribir una línea con el método CELL
$pdf->writeHTML($htmlImprimir, true, false, true, false, '');
 
// ---------------------------------------------------------
 
//Cerramos y damos salida al fichero PDF
//ob_start();
$pdf->Output('reporte.pdf', 'I');
//ob_end_flush();
//ob_end_clean();//ob_clean();