<?php

require_once 'ControladorGeneralPortal.php';

class ControladorLibro extends ControladorGeneralPortal {

    function __construct() {
        parent::__construct();
    }

    public function listarDestacados() {
        try {
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DBSentenciasPortal::LISTAR_LIBROS_DESTACADOS);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Libro-listar: " . $e->getMessage());
        }
    }
    
    public function listarUltimos() {
        try {
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DBSentenciasPortal::LISTAR_ULTIMOS_LIBROS);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Libro-listar: " . $e->getMessage());
        }
    }

    public function lista($datos) {
        
    }

}
