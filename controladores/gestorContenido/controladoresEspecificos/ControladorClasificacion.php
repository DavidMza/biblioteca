<?php

require_once 'ControladorGeneral.php';
require_once 'ControladorLog.php';

class ControladorClasificacion extends ControladorGeneral {

    private $refLog;
    
    function __construct() {
        parent::__construct();
        $this->refLog = new ControladorLog();
    }

    public function buscar($datos) {
        try {
            $parametros = array("id" => $datos["id"]);
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::BUSCAR_LIBRO_CLASIFICACION,$parametros);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Clasificacion-buscar: " . $e->getMessage());
        }
    }

    public function listar() {
        try {
            session_start();
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_CLASIFICACIONES);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $listado[0]["parent"] = "#";
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Clasificacion-listar: " . $e->getMessage());
        }
    }
    
    public function listarLog() {
        try {
            unset($parametros);
            $parametros = array("entidad" => Constantes::ENTIDAD_CLASIFICACION);
            $listado = $this->refLog->listarLog($parametros);
            //$listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Clasificacion-listarLog: " . $e->getMessage());
        }
    }
    
    public function agregar($datos) {
        try {
            session_start();
            $parametros = array("nombre" => $datos["nombre"], "padre" => $datos["padre"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::AGREGAR_CLASIFICACION, $parametros);
            
            $id_clasi = $this->ultimoID();
            
            unset($parametros);
            $parametros = array("accion" => Constantes::ACCION_ALTA, "entidad" => Constantes::ENTIDAD_CLASIFICACION, "id_Usuario" => $_SESSION["user"], "nombre" => $datos["nombre"]);
            $this->refLog->registrarLog($parametros);
            
            return $id_clasi;
        } catch (Exception $e) {
            throw new Exception("Clasificacion-agregar: " . $e->getMessage());
        }
    }

    public function modificar($datos) {
        try {
            session_start();
            $parametros = array("nombre" => $datos["nombre"], "padre" => $datos["padre"], "id" => $datos["id"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::MODIFICAR_CLASIFICACION, $parametros);
            
            $id_clasi = $datos["id"];
            
            unset($parametros);
            $parametros = array("accion" => Constantes::ACCION_MODIFICACION, "entidad" => Constantes::ENTIDAD_CLASIFICACION, "id_Usuario" => $_SESSION["user"], "nombre" => $datos["nombre"]);
            $this->refLog->registrarLog($parametros);
            
        } catch (Exception $e) {
            throw new Exception("Clasificacion-modificar: " . $e->getMessage());
        }
    }

    public function eliminar($datos) {
        try {
            session_start();
            $nombre = $this->traerNombre($datos["id"]);
            $parametros = array("id" => $datos["id"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::ELIMINAR_CLASIFICACION, $parametros);
            
            
            unset($parametros);
            $parametros = array("accion" => Constantes::ACCION_BAJA, "entidad" => Constantes::ENTIDAD_CLASIFICACION, "id_Usuario" => $_SESSION["user"], "nombre" => $nombre);
            $this->refLog->registrarLog($parametros);
            
        } catch (Exception $e) {
            throw new Exception("Clasificacion-eliminar: " . $e->getMessage());
        }
    }

    private function ultimoID() {
        $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::ULTIMO_ID_CLASIFICACION);
        $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $listado[0]["MAX(id_clasificacion)"];
    }
    
    private function traerNombre($id) {
        $parametros = array("id" => $id);
        $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::NOMBRE_CLASIFICACION, $parametros);
        $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $listado[0]["nombre"];
    }

}
