<?php

require_once 'ControladorGeneralPortal.php';

class ControladorClasificacion extends ControladorGeneralPortal {

    function __construct() {
        parent::__construct();
    }

    public function listar() {
        try {
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DBSentenciasPortal::LISTAR_CLASIFICACIONES);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            unset($listado[0]);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Clasificacion-listar: " . $e->getMessage());
        }
    }

    public function agregar($datos) {
        
    }

    public function modificar($datos) {
        
    }

    public function lista($datos) {
        
    }

}
