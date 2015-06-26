<!DOCTYPE html>
<html lang="en">
    <?php
    require_once '../controladores/portalWeb/persistencia/ControladorPersistencia.php';
    require_once '../controladores/portalWeb/persistencia/DBSentenciasPortal.php';
    include_once 'funciones.php';
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
                    <a class="navbar-brand" href="index.php">Portal biblioteca</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="../gestorContenido/login/login.html">Log In</a>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-right" method="get" action="index.php">
                        <input class="form-control" type="text" name="q" id="q" placeholder="Search...">
                    </form>
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
                    <h1 class="page-header">Libros
                        <small>Destacados</small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->
            <?php
            dibujarContenido($listado);
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

        <!-- INICIO MODAL -->

        <div class="modal fade" id="modalLibroPortal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal">Libro</h4>
                    </div>
                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>
                                    <img id="foto">
                                </td>
                                <td>
                                    <table>
                                        <tr>
                                            <th><label class='col-lg-2'>Titulo:</label></th>
                                            <td><label id="titulo" class='col-lg-4'></label></td>
                                        </tr>
                                        <tr>
                                            <th><label class='col-lg-2'>ISBN:</label></th>
                                            <td><label id="isbn" class='col-lg-4'></label></td>
                                        </tr>
                                        <tr>
                                            <th><label class='col-lg-2'>Paginas:</label></th>
                                            <td><label id="paginas" class='col-lg-4'></label></td>
                                        </tr>
                                        <tr>
                                            <th><label class='col-lg-2'>Idioma:</label></th>
                                            <td><label id="idioma" class='col-lg-4'></label></td>
                                        </tr>
                                        <tr>
                                            <th><label class='col-lg-2'>Año Publicacion:</label></th>
                                            <td><label id="pubicacion" class='col-lg-4'></label></td>
                                        </tr>
                                        <tr>
                                            <th><label class='col-lg-2'>Autor:</label></th>
                                            <td><label id="autor" class='col-lg-4'></label></td>
                                        </tr>
                                        <tr>
                                            <th><label class='col-lg-2'>Editorial:</label></th>
                                            <td><label id="editorial" class='col-lg-4'></label></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- FIN MODAL -->

        <!-- jQuery -->
        <script src="../recursos/portalWeb/js/jquery.js" type="text/javascript"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../recursos/portalWeb/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/funciones.js" type="text/javascript"></script>
    </body>
</html>