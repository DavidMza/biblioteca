<?php

require_once 'ControladorGeneral.php';
require_once 'Constantes.php';

class ControladorLog extends ControladorGeneral {

    function __construct() {
        parent::__construct();
    }
    
    public function listarLog($datos) {
        try {
            session_start();
            $resultado = null;
            if ($_SESSION["tipo"] == Constantes::USER_SUPER_ADMINISTRADOR) {
                $parametros = array("entidad" => $datos["entidad"]);
                $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LOG_LISTAR,$parametros);
            }
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Listar_Logs: " . $e->getMessage());
        }
    }
    
    public function registrarLog($datos){
        try {
        $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LOG_REGISTRAR,$datos);
        } catch (Exception $e) {
            throw new Exception("Registrar_Logs: " . $e->getMessage());
        }
    }
    
    public function listar() {
        
    }

    public function agregar($datos) {
        
    }

    public function modificar($datos) {
        
    }

}
