<?php

require_once 'ControladorGeneral.php';
//require_once 'ControladorLogEditoriales.php';

class ControladorContacto extends ControladorGeneral {

    function __construct() {
        parent::__construct();
    }

    public function agregar($datos) {
        
    }

    public function listar() {
        try {
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_CONTACTOS);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Contacto-listar: " . $e->getMessage());
        }
    }

    public function eliminar($datos) {
        try {
            $parametros = array("id" => $datos["id"]);
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::ELIMINAR_CONTACTO,$parametros);
        } catch (Exception $e) {
            throw new Exception("Contacto-eliminar: " . $e->getMessage());
        }
    }
    
    public function modificar($datos) {
        
    }

}
