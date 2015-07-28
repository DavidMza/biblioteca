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
                    <li><a href="home.php">Home</a></li>
                    <li><a href="buscador.php">Buscador</a></li>
                    <li><a href="acerca.php">Acerca de</a></li>
                    <li><a href="contacto.php" class="active">Contacto</a></li>
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
                                    <a href="buscador.php?clas=<?php echo base64_encode($value["id"])."&pag=1" ?>"><?php echo $value["text"] ?></a>
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
                                    <a href="buscador.php?car=<?php echo base64_encode($value["id"])."&pag=1" ?>"><?php echo $value["text"] ?></a>
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
                <div class="contacto">
                    <h3>Envie su consulta</h3>
                    <form action="enviarConsulta.php" method="post">

                        <label>Nombre</label>
                        <input name="name" placeholder="Tu Nombre">

                            <label>Email</label>
                            <input name="email" type="email" placeholder="Tu E-Mail">

                                <label>Mensaje</label>
                                <textarea name="message" placeholder="Tu Consulta" maxlength="500" ></textarea>

                                <input id="submit" class="myButton" name="submit" type="submit" value="Enviar">

                                    </form>
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
                                                        <input type="text" class="field" name="nombre" value="Tu Nombre" title="Your Name" />
                                                        <input type="text" class="field" name="mail" value="Email" title="Email" />
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