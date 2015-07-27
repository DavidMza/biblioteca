<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
    <?php
    require_once __DIR__ . '/../../controladores/portalWeb/persistencia/DBSentenciasPortal.php';
    require_once __DIR__ . '/../../controladores/portalWeb/persistencia/ControladorPersistencia.php';
    $controladorPersistencia = ControladorPersistencia::obtenerCP();
    require_once './funciones.php';
    ?>
    <head>
        <title>Biblioteca</title>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />

        <link rel="shortcut icon" href="../../recursos/portalWeb/home/css/images/favicon.ico" />
        <link href="../../recursos/portalWeb/home/css/style.css" rel="stylesheet" type="text/css"/>
        <script src="../../recursos/portalWeb/home/js/jquery-1.6.2.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../../recursos/portalWeb/home/js/jquery.jcarousel.min.js"></script>
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
                    <li><a href="buscador.php" class="active">Buscador</a></li>
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
                        <h4>Editoriales</h4>
                        <ul>
                            <?php
                            $resultado = $controladorPersistencia->ejecutarSentencia(DBSentenciasPortal::LISTAR_EDITORIALES);
                            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($listado as $value) {
                                ?>
                                <li>
                                    <a href="buscador.php?edi=<?php echo base64_encode($value["id"]) ?>"><?php echo $value["text"] ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li>
                        <h4>Clasificacion</h4>
                        <ul id="clasif">
                            <?php
                            $resultado = $controladorPersistencia->ejecutarSentencia(DBSentenciasPortal::LISTAR_CLASIFICACIONES);
                            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
                            unset($listado[0]);
                            foreach ($listado as $value) {
                                ?>
                                <li>
                                    <a href="buscador.php?clas=<?php echo base64_encode($value["id"]) ?>"><?php echo $value["text"] ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li>
                        <h4>Caracteristicas</h4>
                        <ul id="caract">
                            <?php
                            $resultado = $controladorPersistencia->ejecutarSentencia(DBSentenciasPortal::LISTAR_CARACTERISTICAS);
                            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($listado as $value) {
                                ?>
                                <li>
                                    <a href="buscador.php?car=<?php echo base64_encode($value["id"]) ?>"><?php echo $value["text"] ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- End Sidebar -->
            <!-- Content -->
            <div id="content">
                <form action="buscador.php" method="get">
                    <input type="text" name="q" class="buscador2"><input type="submit" class="myButton" value="Buscar" >
                            </form>
                            <br>
                                <!-- Products -->
                                <div class="products">
                                    <?php
                                    if (count($_GET) > 0) {
                                        ?>
                                        <h3>Resultado de la Busqueda</h3>
                                        <ul>
                                            <?php
                                            $resultado = null;
                                            $listado = array();
                                            if (isset($_GET["edi"])) {
                                                $resultado = $controladorPersistencia->ejecutarSentencia(DBSentenciasPortal::LISTAR_X_EDITORIAL, array(base64_decode($_GET["edi"])));
                                                $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
                                            } elseif (isset($_GET["clas"])) {
                                                $resultado = $controladorPersistencia->ejecutarSentencia(DBSentenciasPortal::LISTAR_X_CLASIFICACION, array(base64_decode($_GET["clas"])));
                                                $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
                                            } elseif (isset($_GET["car"])) {
                                                $resultado = $controladorPersistencia->ejecutarSentencia(DBSentenciasPortal::LISTAR_X_CARACTERISTICA, array(base64_decode($_GET["car"])));
                                                $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
                                            } elseif (isset($_GET["q"])) {
                                                $query = DBSentenciasPortal::LISTAR_X_BUSQUEDA;
                                                $query = str_replace("LIKE ?", "LIKE '%" . $_GET["q"] . "%'", $query);
                                                $resultado = $controladorPersistencia->ejecutarSentencia($query);
                                                $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
                                            } elseif (isset($_GET["des"])) {
                                                $resultado = $controladorPersistencia->ejecutarSentencia(DBSentenciasPortal::LISTAR_X_DESTACADOS);
                                                $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
                                            }
                                            if (count($listado) > 0) {
                                                foreach ($listado as $value) {
                                                    ?>
                                                    <li>
                                                        <div class="product">
                                                            <a href="detalle.php?lib=<?php echo base64_encode($value["lib"]) ?>" class="info">
                                                                <span class="holder">
                                                                    <img src="../../<?php echo $value["ruta"] ?>" alt="" />
                                                                    <span class="book-name"><?php echo truncarString($value["titulo"], 15) ?></span>
                                                                    <span class="author">by <?php echo $value["autor"] ?></span>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </li>
                                                    <?php
                                                }
                                            } else {
                                                echo "<h4>No hay resultados</h4>";
                                            }
                                            ?>
                                        </ul>
                                        <?php
                                    } else {
                                        ?>
                                        <h3>No se ha realizado ninguna busqueda</h3>
                                    <?php } ?>
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
                                                    <li><a href="home.php" class="active">Home</a></li>
                                                    <li><a href="buscador.php">Buscador</a></li>
                                                    <li><a href="acerca.php">Acerca de</a></li>
                                                    <li><a href="contacto.php">Contacto</a></li>
                                                    <li><a href="../../gestorContenido/login/login.html">Gestor</a></li>
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