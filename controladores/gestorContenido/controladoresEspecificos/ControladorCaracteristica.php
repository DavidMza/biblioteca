<?php

require_once 'ControladorGeneral.php';
require_once 'ControladorLog.php';

class ControladorCaracteristica extends ControladorGeneral {

    private $refLog;

    function __construct() {
        parent::__construct();
        $this->refLog = new ControladorLog();
    }

    public function listar() {
        try {
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_CARACTERISTICAS);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Caracteristica-listar: " . $e->getMessage());
        }
    }
    
        public function listarLog() {
        try {
            unset($parametros);
            $parametros = array("entidad" => Constantes::ENTIDAD_CARACTERISTICA);
            $listado = $this->refLog->listarLog($parametros);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Caracteristica-listarLog: " . $e->getMessage());
        }
    }

    public function agregar($datos) {
        try {
            session_start();
            $parametros = array("nombreCaracteristica" => $datos["denominacion"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::AGREGAR_CARACTERISTICA, $parametros);
            
            //Rescato la caracteristica insertada
            $idUltimaCaracteristica = $this->ultimoID();
            
            unset($parametros);
            $parametros = array("accion" => Constantes::ACCION_ALTA, "entidad" => Constantes::ENTIDAD_CARACTERISTICA, "id_Usuario" => $_SESSION["user"], "nombre" => $datos["denominacion"]);
            $this->refLog->registrarLog($parametros);

            return $idUltimaCaracteristica;
        } catch (Exception $e) {
            throw new Exception("Caracteristica-agregar: " . $e->getMessage());
        }
    }

    public function modificar($datos) {
        try {
            session_start();
            //Cargo los parametros y aplico la modificacion
            $parametros = array("nombreCaracteristica" => $datos["denominacion"], "id" => $datos["id"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::MODIFICAR_CARACTERISTICA, $parametros);

            unset($parametros);
            $parametros = array("accion" => Constantes::ACCION_MODIFICACION, "entidad" => Constantes::ENTIDAD_CARACTERISTICA, "id_Usuario" => $_SESSION["user"], "nombre" => $datos["denominacion"]);
            $this->refLog->registrarLog($parametros);
            
        } catch (Exception $e) {
            throw new Exception("Caracteristica-modificar: " . $e->getMessage());
        }
    }

    public function eliminar($datos) {
        try {
            session_start();
            //Primero rescato el nombre de la caracteristica que voy a eliminar
            $nombre = $this->traerNombreCaracteristica($datos["id"]);
            $parametros = array("id" => $datos["id"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::ELIMINAR_CARACTERISTICA, $parametros);

            unset($parametros);
            $parametros = array("accion" => Constantes::ACCION_BAJA, "entidad" => Constantes::ENTIDAD_CARACTERISTICA, "id_Usuario" => $_SESSION["user"], "nombre" => $nombre);
            $this->refLog->registrarLog($parametros);
            
        } catch (Exception $e) {
            throw new Exception("Editorlal-eliminar: " . $e->getMessage());
        }
    }

    private function ultimoID() {
        $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::ULTIMA_CARACTERISTICA);
        $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $listado[0]["id"];
    }

    private function traerNombreCaracteristica($id) {
        $parametros = array("id" => $id);
        $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::NOMBRE_CARACTERISTICA, $parametros);
        $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $listado[0]["nombre"];
    }
    
    public function buscar($datos) {
        try {
            $parametros = array("id" => $datos["id"]);
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::BUSCAR_LIBRO_CARACTERISTICA, $parametros);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Caracteristica-buscar: " . $e->getMessage());
        }
    }

}
