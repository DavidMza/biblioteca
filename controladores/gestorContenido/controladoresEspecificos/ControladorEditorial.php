<?php

require_once 'ControladorGeneral.php';
require_once 'ControladorLog.php';

class ControladorEditorial extends ControladorGeneral {

    private $refLog;

    function __construct() {
        parent::__construct();
        $this->refLog = new ControladorLog();
    }

    public function listar() {
        try {
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_EDITORIALES);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Editorial-listar: " . $e->getMessage());
        }
    }
    
    public function listarLog() {
        try {
            unset($parametros);
            $parametros = array("entidad" => Constantes::ENTIDAD_EDITORIAL);
            $listado = $this->refLog->listarLog($parametros);
            //$listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Editorial-listarLog: " . $e->getMessage());
        }
    }

    public function agregar($datos) {
        try {
            session_start();
            $parametros = array("nombreEditorial" => $datos["nombre"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::AGREGAR_EDITORIAL, $parametros);
            
            //Rescato la editorial insertada
            $idUltimaEditorial = $this->ultimoID();
            
            unset($parametros);
            $parametros = array("accion" => Constantes::ACCION_ALTA, "entidad" => Constantes::ENTIDAD_EDITORIAL, "id_Usuario" => $_SESSION["user"], "nombre" => $datos["nombre"]);
            $this->refLog->registrarLog($parametros);

            return $idUltimaEditorial;
        } catch (Exception $e) {
            throw new Exception("Editorial-agregar: " . $e->getMessage());
        }
    }

    public function modificar($datos) {
        try {
            session_start();
            //Cargo los parametros y aplico la modificacion
            $parametros = array("nombreEditorial" => $datos["nombre"], "id" => $datos["id"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::MODIFICAR_EDITORIAL, $parametros);

            unset($parametros);
            $parametros = array("accion" => Constantes::ACCION_MODIFICACION, "entidad" => Constantes::ENTIDAD_EDITORIAL, "id_Usuario" => $_SESSION["user"], "nombre" => $datos["nombre"]);
            $this->refLog->registrarLog($parametros);
            
        } catch (Exception $e) {
            throw new Exception("Editorial-modificar: " . $e->getMessage());
        }
    }

    public function eliminar($datos) {
        try {
            session_start();
            //Primero rescato el nombre de la editorial que voy a eliminar
            $nombreEditorialAnterior = $this->traerNombreEditorial($datos["id"]);
            $parametros = array("id" => $datos["id"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::ELIMINAR_EDITORIAL, $parametros);

            unset($parametros);
            $parametros = array("accion" => Constantes::ACCION_BAJA, "entidad" => Constantes::ENTIDAD_EDITORIAL, "id_Usuario" => $_SESSION["user"], "nombre" => $nombreEditorialAnterior);
            $this->refLog->registrarLog($parametros);
            
            
        } catch (Exception $e) {
            throw new Exception("Editorlal-eliminar: " . $e->getMessage());
        }
    }

    private function ultimoID() {
        $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::ULTIMA_EDITORIAL);
        $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $listado[0]["id"];
    }

    private function traerNombreEditorial($id) {
        $parametros = array("id" => $id);
        $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::NOMBRE_EDITORIAL, $parametros);
        $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $listado[0]["nombre"];
    }

    public function contarEditorialesCargadas($datos = null) {
        try {
            session_start();
            $resultado = null;
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::CONTAR_EDITORIALES_CARGADAS);
            $retorno = array();
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);

            $retorno["cantTotal"] = $listado[0]["editoriales"];
            $resultado = null;
            $parametros = array("usuario" => $_SESSION["user"]);
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::CONTAR_EDITORIALES_CARGADAS_X_USUARIO, $parametros);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);

            $retorno["cantXusu"] = $listado[0]["editoriales"];
            //var_dump($listado);
            //print_r();
            return $retorno;
        } catch (Exception $e) {
            throw new Exception("Libro-CotarTodo: " . $e->getMessage());
        }
    }

}
