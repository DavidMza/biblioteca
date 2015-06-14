<?php

require_once '../persistencia/ControladorPersistencia.php';
require_once '../persistencia/DBSentencias.php';

abstract class ControladorGeneral implements DBSentencias {

    protected $refControladorPersistencia;

    function __construct() {
        $this->refControladorPersistencia = ControladorPersistencia::obtenerCP();
    }
    
    abstract function listar();

    abstract function agregar($datos);

    abstract function modificar($datos);

    function eliminar($datos){
        try{
            $this->refControladorPersistencia->ejecutarSentencia(DBSentencias::ELIMINAR, $datos);
        }catch (Exception $e){
            throw new Exception($datos["tabla"] . "-eliminar: " . $e->getMessage());
        }  
    }
}
