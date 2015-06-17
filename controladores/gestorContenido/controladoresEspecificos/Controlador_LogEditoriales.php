<?php

require_once 'ControladorGeneral.php';

class Controlador_LogEditoriales extends ControladorGeneral {

    private $idEditorial;
    private $idUsuario;
    //Acciones
    private $accion = array("A" => "1",
        "B" => "2",
        "M" => "3");

    function __construct($datos) {
        parent::__construct();
        $this->idEditorial = $datos["id_Editorial"];
        $this->idUsuario = $datos["id_Usuario"];
    }

    public function agregar($datos = null) {
        try {
            $parametros = array($this->accion["A"], $this->idEditorial, $this->idUsuario);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::NUEVO_LOG_EDITORIAL, $parametros);
        } catch (Exception $e) {
            throw new Exception("Log-Editorial-agregar: " . $e->getMessage());
        }
    }

    public function modificar($datos = null) {
        try {
            $parametros = array($this->accion["M"], $this->idEditorial, $this->idUsuario);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::NUEVO_LOG_EDITORIAL, $parametros);
        } catch (Exception $e) {
            throw new Exception("Log-Editorial-modificar: " . $e->getMessage());
        }
    }

    public function eliminar($datos = null) {
        try {
            $parametros = array($this->accion["B"], $this->idEditorial, $this->idUsuario);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::NUEVO_LOG_EDITORIAL, $parametros);
        } catch (Exception $e) {
            throw new Exception("Log-Editorial-eliminar: " . $e->getMessage());
        }
    }

    public function listar() {
        
    }

}
