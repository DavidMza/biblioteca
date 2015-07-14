<?php

require_once 'ControladorGeneralPortal.php';

class ControladorCaracteristica extends ControladorGeneralPortal {

    function __construct() {
        parent::__construct();
    }


    public function listar() {
        try {
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DBSentenciasPortal::LISTAR_CARACTERISTICAS);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Caracteristica-listar: " . $e->getMessage());
        }
    }

    public function lista($datos) {
        
    }

}
