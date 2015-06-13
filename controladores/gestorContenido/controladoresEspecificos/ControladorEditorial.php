<?php
require_once '../persistencia/DBSentencias.php';

class ControladorEditorial extends ControladorGeneral{
    
    function __construct() {
        parent::__construct();
    }
    
    public function listar() {
        try {
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_EDITORIALES);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Editorial-listar: " . $e->getMessage());
        }
    }
    
    public function agregar($datos) {
        try{
            $parametros = array("nombreEditorial" => "editorial");
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::AGREGAR_EDITORIAL, $parametros);
        }  catch (Exception $e){
            throw new Exception("Editorial-agregar: " . $e->getMessage());
        }
    }

    public function modificar($datos) {
        try{
            $parametros = array("nombreEditorial" => "editorial", "id" => "idEditorial");
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::MODIFICAR_EDITORIAL, $parametros);
        }  catch (Exception $e){
            throw new Exception("Editorial-modificar: " . $e->getMessage());
        }    
    }

    public function eliminar($datos) {
        $tabla = "editoriales";
        $nombreID = "id_editorial";
        $parametros = array("tabla" => $tabla, "nombreID" => $nombreID , "id" => $datos["id_editorial"]);
        parent::eliminar($parametros);
    }


}
