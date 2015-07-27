<?php
require_once 'ControladorGeneralPortal.php';

class ControladorConsultas extends ControladorGeneralPortal {
    function __construct() {
        parent::__construct();
    }
    
    public function nuevoMensaje($datos) {
        try {
            $parametros = array("nombreAutor" => $datos["nombre"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::AGREGAR_AUTOR, $parametros);
            $id_autor = $this->ultimoID();
            $parametros = array("id" => $id_autor, "usuario" => $_SESSION["usuario"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LOG_AGREGAR_AUTORES, $parametros);
            return $id_autor;
        } catch (Exception $e) {
            throw new Exception("Mensaje-portal-cliente: " . $e->getMessage());
        }
    }
    
    private function lista($datos = null) {
        
    }

}
