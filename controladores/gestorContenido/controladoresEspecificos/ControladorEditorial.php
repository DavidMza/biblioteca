<?php
require_once '../persistencia/DBSentencias.php';

class ControladorEditorial extends ControladorGeneral{
    
    function __construct() {
        parent::__construct();
    }
    
    public function listar($datos) {
        
    }
    
    public function agregar($datos) {
        $parametros = ["nombreEditorial" => "editorial"];
        $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::AGREGAR_EDITORIAL, $parametros);
    }

    public function modificar($datos) {
        $parametros = ["nombreEditorial" => "editorial", "id" => "idEditorial"];
        $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::MODIFICAR_EDITORIAL, $parametros);
    }

    public function eliminar($datos) {
        $tabla = "editoriales";
        $nombreID = "id_editorial";
        $parametros = ["tabla" => $tabla, "nombreID" => $nombreID , "id" => $datos["id_editorial"]];
        parent::eliminar($parametros);
    }


}
