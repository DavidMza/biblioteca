<?php

require_once 'ControladorGeneralPortal.php';

class ControladorLibroPortal extends ControladorGeneralPortal{
    function __construct() {
        parent::__construct();
    }
    public function lista($datos) {
        try {
            $parametros = array("id" => $datos["id"]);
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DBSentenciasPortal::TRAER_LIBRO, $parametros);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            //print_r($listado);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("portal-listar-UN-libro: " . $e->getMessage());
        }
    }

}
