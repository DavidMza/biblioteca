<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
    <?php
    require_once __DIR__ . '/../controladores/portalWeb/persistencia/DBSentenciasPortal.php';
    require_once __DIR__ . '/../controladores/portalWeb/persistencia/ControladorPersistencia.php';
    $controladorPersistencia = ControladorPersistencia::obtenerCP();
    $resultado = $controladorPersistencia->ejecutarSentencia(DBSentenciasPortal::TRAER_LIBRO, array(base64_decode($_GET["lib"])));
    $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $listado = $listado[0];
    ?>
    <head>
        <title>Biblioteca</title>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />

        <link rel="shortcut icon" href="../recursos/portalWeb/home/css/images/favicon.ico" />
        <link href="../recursos/portalWeb/home/css/style.css" rel="stylesheet" type="text/css"/>
        <script src="../recursos/portalWeb/home/js/jquery-1.6.2.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../recursos/portalWeb/home/js/jquery.jcarousel.min.js"></script>
        <script src="funcionesHome.js" type="text/javascript"></script>
        <script src="js/home.js" type="text/javascript"></script>
    </head>
    <body>
        <!-- Header -->
        <div id="header" class="shell">
            <div id="logo"><h1><a href="home.php">Biblioteca</a></h1><span><a href="home.php">2.0</a></span></div>
            <!-- Navigation -->
            <div id="navigation">
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="buscador.php">Buscador</a></li>
                    <li><a href="acerca.php">Acerca de</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                </ul>
            </div>
            <!-- End Navigation -->
            <div class="cl">&nbsp;</div>
            <!-- Login-details -->
            <div id="login-details">

            </div>
            <!-- End Login-details -->
        </div>
        <!-- End Header -->
        <!-- Main -->
        <div id="main" class="shell">
            <!-- Sidebar -->
            <div id="sidebar">
                <ul class="categories">
                    <li>
                        <h4>Portada</h4>
                        <ul>
                            <img src="../<?php echo $listado["ruta"] ?>" width="175px" height="280px"></img>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- End Sidebar -->
            <!-- Content -->
            <div id="content">

                <!-- Products -->
                <div class="detalles">
                    <?php
                    ?>
                    <h3>Detalles del Libro</h3>
                    <ul>
                        <li>
                            <div>
                                <span class="holder">
                                    <table>
                                        <tr>
                                            <td>
                                                <span class="titulo" name="titulo">Titulo: <?php echo $listado["titulo"] ?></span>
                                                <span class="detalle"><b>ISBN:</b> <?php echo $listado["isbn"] ?></span>
                                                <span class="detalle"><b>Autor:</b> <a href="buscador.php?q=<?php echo $listado["autor"] . "&pag=1" ?>"><?php echo $listado["autor"] ?></a></span>
                                                <span class="detalle"><b>Editorial:</b> <a href="buscador.php?edi=<?php echo base64_encode($listado["idEditorial"]) . "&pag=1" ?>"><?php echo $listado["editorial"] ?></a></span>
                                                <span class="detalle"><b>Paginas:</b> <?php echo $listado["paginas"] ?></span>
                                                <span class="detalle"><b>Año Publicacion:</b> <?php echo $listado["publicacion"] ?></span>
                                                <span class="detalle"><b>Idioma:</b> <?php echo $listado["idioma"] ?></span>
                                            </td>
                                            <td width="30px"></td>
                                            <td valign="top">
                                                <b class="detalle">Resumen del Libro:</b>
                                                <br>
                                                    <textarea class="form-control" readonly style="width: 363px; height: 107px;"><?php echo $listado["resumen"] ?></textarea>
                                            </td>
                                        </tr>
                                    </table>

                                    <h3>Clasificaciones</h3>
                                    <?php
                                    $resultado = $controladorPersistencia->ejecutarSentencia(DBSentenciasPortal::TRAER_CLASIFICACIONES_LIBRO, array(base64_decode($_GET["lib"])));
                                    $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($listado as $value) {
                                        ?>
                                        <a class="clasificaciones" href="buscador.php?clas=<?php echo base64_encode($value["id"]) . "&pag=1" ?>"><?php echo $value["text"] ?></a>
                                    <?php } ?>
                                    <h3>Caracteristicas</h3>
                                    <?php
                                    $resultado = $controladorPersistencia->ejecutarSentencia(DBSentenciasPortal::TRAER_CARACTERISTICAS_LIBRO, array(base64_decode($_GET["lib"])));
                                    $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($listado as $value) {
                                        ?>
                                        <a class="clasificaciones" href="buscador.php?car=<?php echo base64_encode($value["id"]) . "&pag=1" ?>"><?php echo $value["text"] ?></a>
                                    <?php } ?>
                                </span>

                            </div>
                        </li>

                    </ul>
                    <!-- End Products -->
                </div>
                <div class="cl">&nbsp;</div>

            </div>
            <!-- End Content -->
            <div class="cl">&nbsp;</div>
        </div>
        <!-- End Main -->
        <!-- Footer -->
        <div id="footer" class="shell">
            <div class="top">
                <div class="cnt">
                    <div class="col about">
                        <h4>Acerca de Biblioteca</h4>
                        <p> Portal Web realizado para la gestion de contenido de una Biblioteca On-line.</p>
                    </div>
                    <div class="col store">
                        <h4>Navegacion</h4>
                        <ul>
                            <li><a href="home.php">Home</a></li>
                            <li><a href="buscador.php" class="active">Buscador</a></li>
                            <li><a href="acerca.php">Acerca de</a></li>
                            <li><a href="contacto.php">Contacto</a></li>
                            <li><a href="../gestorContenido/login/login.html">Gestor</a></li>
                        </ul>
                    </div>
                    <div class="col" id="newsletter">
                        <h4>Registrarme</h4>
                        <p>Quedara registrado para ser notificado cuando salgan nuevos libros. </p>
                        <form action="registrar.php" method="post">
                            <input type="text" class="field" name="nombre" placeholder="Tu Nombre" title="Your Name" require />
                            <input type="text" class="field" name="mail" placeholder="Email" title="Email" require />
                            <div class="form-buttons"><input type="submit" value="Submit" class="submit-btn" /></div>
                        </form>
                    </div>
                    <div class="cl">&nbsp;</div>
                    <div class="copy">
                        <p>Copyright &copy; <a href="#">Biblioteca</a>. Diseñado por Emmanuel Caceres - David Senese</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer -->
        <!--script src="js/funcionesHome.js" type="text/javascript"></script-->
    </body>
</html>