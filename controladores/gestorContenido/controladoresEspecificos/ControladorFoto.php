<?php
require_once '../persistencia/DBSentencias.php';

class ControladorFoto extends ControladorGeneral{
    function __construct() {
        parent::__construct();
    }
    
    public function listar() {
        try {
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_FOTO_ORDER_LIBROS);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Foto-listar: " . $e->getMessage());
        }
    }
    
    public function agregar($datos) {
        try{
            $parametros = array("urlFoto" => "urlFoto");
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::AGREGAR_FOTO, $parametros);
        }  catch (Exception $e){
            throw new Exception("Foto-agregar: " . $e->getMessage());
        }
    }

    public function modificar($datos) {
        try{
            $parametros = array("urlFoto" => "urlFoto", "id" => "idFoto");
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::MODIFICAR_FOTO, $parametros);
        }  catch (Exception $e){
            throw new Exception("Foto-modificar: " . $e->getMessage());
        }    
    }

    public function eliminar($datos) {
        $tabla = "fotos";
        $nombreID = "id_foto";
        $parametros = array("tabla" => $tabla, "nombreID" => $nombreID , "id" => $datos["id_editorial"]);
        parent::eliminar($parametros);
    }
}
