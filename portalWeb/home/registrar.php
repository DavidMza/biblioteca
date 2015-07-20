<?php

require_once __DIR__ . '/../../controladores/portalWeb/persistencia/DBSentenciasPortal.php';
require_once __DIR__ . '/../../controladores/portalWeb/persistencia/ControladorPersistencia.php';
$controladorPersistencia = ControladorPersistencia::obtenerCP();
$parametros = array($_POST["nombre"],$_POST["mail"]);
$resultado = $controladorPersistencia->ejecutarSentencia(DBSentenciasPortal::REGISTRAR_EMAIL,$parametros);
header("Location: http://localhost/biblioteca/portalWeb/home/home.php");
