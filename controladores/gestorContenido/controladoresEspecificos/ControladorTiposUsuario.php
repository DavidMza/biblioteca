<?php
require_once 'ControladorGeneral.php';
class ControladorTiposUsuario extends ControladorGeneral {
    function __construct() {
        parent::__construct();
    }
    
    public function listar() {
        try {
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_TIPOS_USUARIO);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Autor-listar: " . $e->getMessage());
        }
    }

    public function agregar($datos) {
        throw new Exception("TiposUsuario-agregar: No Hago Nada");
    }

    public function modificar($datos) {
        throw new Exception("TiposUsuario-modificar: No Hago Nada");
    }

}
