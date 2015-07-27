<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
    <?php
    require_once __DIR__ . '/../../controladores/portalWeb/persistencia/DBSentenciasPortal.php';
    require_once __DIR__ . '/../../controladores/portalWeb/persistencia/ControladorPersistencia.php';
    $controladorPersistencia = ControladorPersistencia::obtenerCP();
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
                    <li><a href="home.php" class="active">Home</a></li>
                    <li><a href="buscador.php">Buscador</a></li>
                    <li><a href="acerca.php">Acerca de</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                </ul>
            </div>
            <!-- End Navigation -->
            <div class="cl">&nbsp;</div>
            <!-- Login-details -->
            <div id="login-details">
                <form class="navbar-form navbar-right">
                    <input class="buscador" type="text" name="buscar" id="buscar" placeholder="Titulo del libro o autor">
                        <button type="button" id="btBuscar" class="myButton">
                            Buscar
                        </button>
                </form>
            </div>
            <!-- End Login-details -->
        </div>
        <!-- End Header -->
        <!-- Slider -->
        <div id="slider">
            <div class="shell">
                <ul id="ultimos">
                    <?php
                    $resultado = $controladorPersistencia->ejecutarSentencia(DBSentenciasPortal::LISTAR_ULTIMOS_LIBROS);
                    $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($listado as $value) {
                        ?>
                        <li>
                            <div class="image">
                                <img src="../../<?php echo $value["ruta"] ?>" alt="" width="175px" height="280px" />
                            </div>
                            <div class="details">
                                <h2><?php echo $value["titulo"] ?></h2>
                                <h3><?php echo $value["autor"] ?></h3>
                                <p class="title"><b>Editorial:</b> <?php echo $value["editorial"] ?></p>
                                <a href="detalle.php?lib=<?php echo base64_encode($value["lib"]) ?>" class="read-more-btn">Ver Detalle</a>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
                <div class="nav">
                    <?php
                    $index = 0;
                    foreach ($listado as $value) {
                        ?>
                        <a href="#"><?php echo $index ?></a>
                        <?php
                        $index++;
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- End Slider -->
        <!-- Main -->
        <div id="main" class="shell">
            <!-- Sidebar -->
            <div id="sidebar">
                <ul class="categories">
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
                <!-- Products -->
                <div class="products">
                    <h3>Libros Destacados</h3><a href="buscador.php?des" class="right">ver todos</a><br>

                        <ul id="destacados">
                            <?php
                            $resultado = $controladorPersistencia->ejecutarSentencia(DBSentenciasPortal::LISTAR_LIBROS_DESTACADOS);
                            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($listado as $value) {
                                ?>
                                <li>
                                    <div class="product">
                                        <a href="detalle.php?lib=<?php echo base64_encode($value["id"]) ?>" class="info">
                                            <span class="holder">
                                                <img src="../../<?php echo $value["ruta"] ?>" alt="" />
                                                <span class="book-name"><?php echo $value["titulo"] ?></span>
                                                <span class="author">by <?php echo $value["autor"] ?></span>
                                            </span>
                                        </a>
                                    </div>
                                </li>
<?php } ?>
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