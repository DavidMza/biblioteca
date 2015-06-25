<!DOCTYPE html>
<html lang="en">
    <?php
    require_once '../controladores/portalWeb/persistencia/ControladorPersistencia.php';
    require_once '../controladores/portalWeb/persistencia/DBSentencias.php';

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

    function paginar($actual, $total, $por_pagina, $enlace) {
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
            $texto .= "NadaA";
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
            $texto .= "<b>NadaS</b>";
        }
        return $texto;
    }
    //Total de registros
    $total = $refControladorPersistencia->ejecutarSentencia(DbSentencias::TOTAL_LOG);
    $total = $total->fetchAll(PDO::FETCH_ASSOC);
    $total = $total[0]["total"]; 
    //echo '<script> alert("Hay ' . $total . ' registros")</script>';

    $tampag = 3; //Cantidad de registros a mostrar pr pagina
    $reg1 = ($pag - 1) * $tampag; // No se, luego lo miro bien xDD

    function reemplazarSignos($p) {
        $query = str_replace("?, ?", $p["reg1"] . " , " . $p["tampag"], DbSentencias::LOG_LIMIT);
        return $query;
    }

    $parametros = array("reg1" => $reg1, "tampag" => $tampag);
    $resultado = $refControladorPersistencia->ejecutarSentencia(reemplazarSignos($parametros));

    $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Portal Web</title>

        <!-- Bootstrap Core CSS -->
        <link href="../recursos/portalWeb/css/bootstrap.css" rel="stylesheet" type="text/css"/>

        <!-- Custom CSS -->
        <link href="../recursos/portalWeb/css/3-col-portfolio.css" rel="stylesheet" type="text/css"/>

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Portal biblioteca</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="../gestorContenido/login/login.html">Log In</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- Page Content -->
        <div class="container">

            <!-- Page Header -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Page Heading
                        <small>Secondary Text</small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->
            <?php
                $i = 1;
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

                //foreach ($listado as $valor) {
                function iniciarRow() {
            ?>
                <!-- Projects Row -->
                <div class="row">
            <?php
                }
            ?>
            <?php
                function terminarRow() {
            ?>
                </div>
                <!-- /.row -->
            <?php
                }
            ?>
            <?php

                function iniciarCelda($datos) {
            ?>
                <div class="col-md-4 portfolio-item">
                    <a href="#">
                        <img class="img-responsive" src="http://placehold.it/700x400" alt="">
                    </a>
                    <h3>
                        <a href="#"><?php echo $datos["hora_log_caracteristica"] ?></a>
                    </h3>
                    <p><?php echo $datos["fecha_log_caracteristica"] ?></p>
                </div>
            <?php
                }
            ?>

            <hr>
            <!-- Pagination -->

            <div class="row text-center">
                <div class="col-lg-12">
                    <ul class="pagination">
                        <?php
                        //Dibujo los botones para navegar
                        echo paginar($pag, $total, $tampag, "index.php?pag=");
                        ?>
                    </ul>
                </div>
            </div>
            <!-- /.row -->
            <hr>
            <!-- Footer -->
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <p>Copyright &copy; Your Website 2014</p>
                    </div>
                </div>
                <!-- /.row -->
            </footer>

        </div>
        <!-- /.container -->
        <!-- jQuery -->
        <script src="../recursos/portalWeb/js/jquery.js" type="text/javascript"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../recursos/portalWeb/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>