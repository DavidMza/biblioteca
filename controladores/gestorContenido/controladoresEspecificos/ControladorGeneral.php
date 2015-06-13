<?php

require_once '../persistencia/ControladorPersistencia.php';
require_once '../persistencia/DBSentencias.php';

abstract class ControladorGeneral {

    protected $refControladorPersistencia;

    function __construct() {
        $this->refControladorPersistencia = ControladorPersistencia::obtenerCP();
    }
    
    abstract function listar($datos);

    abstract function agregar($datos);

    abstract function modificar($datos);

    function eliminar($datos){
        $this->refControladorPersistencia->ejecutarSentencia(DBSentencias::ELIMINAR, $datos);
    }
}
