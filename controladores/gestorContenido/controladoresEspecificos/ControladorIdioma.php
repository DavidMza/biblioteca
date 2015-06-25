<?php

require_once 'ControladorGeneral.php';
require_once 'Constantes.php';

class ControladorIdioma extends ControladorGeneral {

    function __construct() {
        parent::__construct();
    }

    public function agregar($datos) {
        
    }

    public function listar() {
        try {
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_IDIOMAS);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Idioma-listar: " . $e->getMessage());
        }
    }

    public function modificar($datos) {
        
    }

}
