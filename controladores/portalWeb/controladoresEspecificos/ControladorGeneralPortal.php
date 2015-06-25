<?php
//print_r(__DIR__);
require_once __DIR__ . '/../persistencia/ControladorPersistencia.php';
require_once __DIR__ . '/../persistencia/DBSentenciasPortal.php';

abstract class ControladorGeneralPortal implements DBSentenciasPortal {

    protected $refControladorPersistencia;

    function __construct() {
        $this->refControladorPersistencia = ControladorPersistencia::obtenerCP();
    }
    
    abstract function lista($datos);
}
