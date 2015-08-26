<?php

require_once 'ControladorGeneral.php';

class ControladorLogEditoriales extends ControladorGeneral {

    private $idEditorial;
    private $idUsuario;
    private $nombreEditorialAnterior = "-";
    private $nombreEditorialNuevo = "-";
    //Acciones
    private $accion = array("A" => "1",
        "B" => "2",
        "M" => "3");

    function __construct($datos) {
        parent::__construct();
        
        if (isset($datos["id_Editorial"])) {
            $this->idEditorial = $datos["id_Editorial"];
            $this->idUsuario = $datos["id_Usuario"];
            //Se inseratará una nueva editorial
            if (isset($datos["anterior_nombre_Editorial"])) {
                $this->nombreEditorialAnterior = $datos["anterior_nombre_Editorial"];
            }

            if (isset($datos["nuevo_nombre_Editorial"])) {
                $this->nombreEditorialNuevo = $datos["nuevo_nombre_Editorial"];
            }
        }
    }

    public function agregar($datos = null) {
        try {
            $parametros = array($this->nombreEditorialAnterior,
                $this->nombreEditorialNuevo,
                $this->accion["A"],
                $this->idEditorial,
                $this->idUsuario
            );
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::NUEVO_LOG_EDITORIAL, $parametros);
        } catch (Exception $e) {
            throw new Exception("Log-Editorial-agregar: " . $e->getMessage());
        }
    }

    public function modificar($datos = null) {
        try {
            $parametros = array($this->nombreEditorialAnterior,
                $this->nombreEditorialNuevo,
                $this->accion["M"],
                $this->idEditorial,
                $this->idUsuario
            );
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::NUEVO_LOG_EDITORIAL, $parametros);
        } catch (Exception $e) {
            throw new Exception("Log-Editorial-modificar: " . $e->getMessage());
        }
    }

    public function eliminar($datos = null) {
        try {
            $parametros = array($this->nombreEditorialAnterior,
                $this->nombreEditorialNuevo,
                $this->accion["B"],
                $this->idEditorial,
                $this->idUsuario
            );
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::NUEVO_LOG_EDITORIAL, $parametros);
        } catch (Exception $e) {
            throw new Exception("Log-Editorial-eliminar: " . $e->getMessage());
        }
    }

    public function listar() {
        try {
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_LOG_EDITORIAL);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Log-Editorial-listar: " . $e->getMessage());
        }
    }

}
