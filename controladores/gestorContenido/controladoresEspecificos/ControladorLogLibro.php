<?php

require_once 'ControladorGeneral.php';
require_once 'Constantes.php';

class ControladorLogLibro extends ControladorGeneral {

    function __construct() {
        parent::__construct();
    }
    
    public function listar() {
        try {
            session_start();
            $resultado = null;
            if ($_SESSION["tipo"] == Constantes::SUPER_ADMINISTRADOR) {
                $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LOG_LISTAR_LIBROS);
            }
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Libro-listarLogs: " . $e->getMessage());
        }
    }

    public function agregar($datos) {
        
    }

    public function modificar($datos) {
        
    }

}