<?php

require_once 'ControladorGeneral.php';

class ControladorLogCaracteristicas extends ControladorGeneral {

    private $idCaracteristica;
    private $idUsuario;
    private $nombreCaracteristicaAnterior = "-";
    private $nombreCaracteristicaNuevo = "-";
    //Acciones
    private $accion = array("A" => "1",
        "B" => "2",
        "M" => "3");

    function __construct($datos) {
        parent::__construct();
        
        if (isset($datos["id_Caracteristica"])) {
            $this->idCaracteristica = $datos["id_Caracteristica"];
            $this->idUsuario = $datos["id_Usuario"];
            //Se inseratará una nueva caracteristica
            if (isset($datos["anterior_nombre_Caracteristica"])) {
                $this->nombreCaracteristicaAnterior = $datos["anterior_nombre_Caracteristica"];
            }

            if (isset($datos["nuevo_nombre_Caracteristica"])) {
                $this->nombreCaracteristicaNuevo = $datos["nuevo_nombre_Caracteristica"];
            }
        }
    }

    public function agregar($datos = null) {
        try {
            $parametros = array($this->nombreCaracteristicaAnterior,
                $this->nombreCaracteristicaNuevo,
                $this->accion["A"],
                $this->idCaracteristica,
                $this->idUsuario
            );
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::NUEVO_LOG_CARACTERISTICA, $parametros);
        } catch (Exception $e) {
            throw new Exception("Log-Caracteristica-agregar: " . $e->getMessage());
        }
    }

    public function modificar($datos = null) {
        try {
            $parametros = array($this->nombreCaracteristicaAnterior,
                $this->nombreCaracteristicaNuevo,
                $this->accion["M"],
                $this->idCaracteristica,
                $this->idUsuario
            );
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::NUEVO_LOG_CARACTERISTICA, $parametros);
        } catch (Exception $e) {
            throw new Exception("Log-Caracteristica-modificar: " . $e->getMessage());
        }
    }

    public function eliminar($datos = null) {
        try {
            $parametros = array($this->nombreCaracteristicaAnterior,
                $this->nombreCaracteristicaNuevo,
                $this->accion["B"],
                $this->idCaracteristica,
                $this->idUsuario
            );
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::NUEVO_LOG_CARACTERISTICA, $parametros);
        } catch (Exception $e) {
            throw new Exception("Log-Caracteristica-eliminar: " . $e->getMessage());
        }
    }

    public function listar() {
        try {
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_LOG_CARACTERISTICA);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Log-Caracteristica-listar: " . $e->getMessage());
        }
    }

}
