<?php
require_once '../persistencia/DBSentencias.php';

class ControladorCaracteristica extends ControladorGeneral{
    
    function __construct() {
        parent::__construct();
    }
    
    public function listar() {
        try {
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_CARACTERISTICAS);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Caracteristica-listar: " . $e->getMessage());
        }
    }

    public function agregar($datos) {
        try{
            $parametros = array("denominacion" => "caracteristica");
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::AGREGAR_CARACTERISTICA, $parametros);
        }  catch (Exception $e){
            throw new Exception("Caracteristica-agregar: " . $e->getMessage());
        }
    }

    public function modificar($datos) {
        try{
            $parametros = array("denominacion" => "caracteristica", "id" => "id_Caracteristica");
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::MODIFICAR_CARACTERISTICA, $parametros);
        }  catch (Exception $e){
            throw new Exception("Caracteristica-modificar: " . $e->getMessage());
        }    
    }

    public function eliminar($datos) {
        $tabla = "caracteristicas";
        $nombreID = "id_caracteristica";
        $parametros = array("tabla" => $tabla, "nombreID" => $nombreID , "id" => $datos["id_Caracteristica"]);
        parent::eliminar($parametros);
    }

}
