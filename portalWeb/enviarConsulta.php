<?php

require_once __DIR__ . '/../controladores/portalWeb/persistencia/DBSentenciasPortal.php';
require_once __DIR__ . '/../controladores/portalWeb/persistencia/ControladorPersistencia.php';
$controladorPersistencia = ControladorPersistencia::obtenerCP();
$parametros = array($_POST["name"],$_POST["email"],$_POST["message"]);
$resultado = $controladorPersistencia->ejecutarSentencia(DBSentenciasPortal::INSERTAR_CONSULTA,$parametros);
header("Location: http://localhost/biblioteca/portalWeb/home/home.php");