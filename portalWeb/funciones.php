<?php

const ruta = "../";

$refControladorPersistencia = ControladorPersistencia::obtenerCP();

if (isset($_GET["pag"])) {
    $pag = $_GET["pag"];
}
if (!isset($pag)) {
    $pag = 1; // Por defecto, pagina 1
}
/* Funcion paginar
 * actual:          Pagina actual
 * total:           Total de registros
 * por_pagina:      Registros por pagina
 * enlace:          Texto del enlace
 * Devuelve un texto que representa la paginacion
 */

function paginar($actual, $total, $por_pagina, $enlace, $bandera = null) {
    $total_paginas = ceil($total / $por_pagina);
    $anterior = $actual - 1;
    $posterior = $actual + 1;
    $texto = "";
    if ($actual > 1) {
        $texto .= "<li>";
        $texto .= "<a href='$enlace$anterior'>Anterior</a>";
        $texto .= "</li>";
    } else {
        $texto .= "<li>";
        $texto .= "";
        $texto .= "</li>";
    }
    for ($i = 1; $i < $actual; $i++) {
        $texto .= "<li>";
        $texto .= "<a href='$enlace$i'>$i</a> ";
        $texto .= "</li>";
    }
    $texto .= "<li class='active'>";
    $texto .= "<a href='#'>$actual</a>";
    $texto .= "</li>";
    for ($i = $actual + 1; $i <= $total_paginas; $i++) {
        $texto .= "<li>";
        $texto .= "<a href='$enlace$i'>$i</a> ";
        $texto .= "</li>";
    }

    if ($actual < $total_paginas) {
        $texto .= "</li>";
        $texto .= "<a href='$enlace$posterior'>Siguiente</a>";
        $texto .= "</li>";
    } else {
        $texto .= "";
    }
    return $texto;
}

//Total de registros
$total = $refControladorPersistencia->ejecutarSentencia(DBSentenciasPortal::TOTAL_LIBROS_PORTADA);
$total = $total->fetchAll(PDO::FETCH_ASSOC);
$total = $total[0]["total"];
//echo '<script> alert("Hay ' . $total . ' registros")</script>';

$tampag = 3; //Cantidad de registros a mostrar pr pagina
$reg1 = ($pag - 1) * $tampag; // No se, luego lo miro bien xDD

function reemplazarSignos($p) {
    $query = str_replace("?, ?", $p["reg1"] . " , " . $p["tampag"], DBSentenciasPortal::LIBROS_PORTADA_LIMIT);
    return $query;
}

//$resultado;

$parametros = array("reg1" => $reg1, "tampag" => $tampag);
$bandera = false;
if (isset($_GET["q"])) {
    $banderaBusqueda = true;
    //print_r($_GET["q"]);
    $getBuscar = $_GET["q"];
    $query = str_replace("LIKE ?", "LIKE '" . $_GET["q"] . "%'", DBSentenciasPortal::BUSCAR);
    $query = str_replace("?, ?", $parametros["reg1"] . " , " . $parametros["tampag"], $query);
    $resultado = $refControladorPersistencia->ejecutarSentencia($query);
} else {
    $banderaBusqueda = false;
    $resultado = $refControladorPersistencia->ejecutarSentencia(reemplazarSignos($parametros));
}
$listado = $resultado->fetchAll(PDO::FETCH_ASSOC);

function iniciarRow() {
    echo "<!-- Projects Row -->";
    echo "<div class='row'>";
}

function terminarRow() {
    echo "</div>";
    echo "<!-- /.row -->";
}

function iniciarCelda($datos) {
    echo '<div class="col-md-4 portfolio-item">';
    echo '<a>';
    echo '<img class="img-responsive" src="' . ruta . $datos["ruta"] . '" alt="" width="150" height="300">';
    echo '</a>';
    echo '<h3>';
    echo '<a data-id="' . $datos["id"] . '" class="titulo">' . $datos["titulo"] . '</a>';
    echo '</h3>';
    echo '<p>' . $datos["autor"] . '</p>';
    echo '</div>';
}

function dibujarContenido($listado) {
    iniciarRow();
    while (current($listado)) {
        //Estoy en el actual
        iniciarCelda(current($listado));
        while (next($listado)) {
            //Estoy en el siguiente, si es que existe
            iniciarCelda(current($listado));
        }
    }
    terminarRow();
}
