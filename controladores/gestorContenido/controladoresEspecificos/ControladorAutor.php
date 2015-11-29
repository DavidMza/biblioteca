<?php

require_once 'ControladorGeneral.php';
require_once 'ControladorLog.php';

class ControladorAutor extends ControladorGeneral {

    private $refLog;
    
    function __construct() {
        parent::__construct();
        $this->refLog = new ControladorLog();
    }

    public function listar() {
        try {
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_AUTORES);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Autor-listar: " . $e->getMessage());
        }
    }
    
    public function listarLog() {
        try {
            unset($parametros);
            $parametros = array("entidad" => Constantes::ENTIDAD_AUTOR);
            $listado = $this->refLog->listarLog($parametros);
            //$listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Autor-listarLog: " . $e->getMessage());
        }
    }

    public function agregar($datos) {
        try {
            session_start();
            $parametros = array("nombreAutor" => $datos["nombre"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::AGREGAR_AUTOR, $parametros);
            
            $id_autor = $this->ultimoID();
            
            unset($parametros);
            $parametros = array("accion" => Constantes::ACCION_ALTA, "entidad" => Constantes::ENTIDAD_AUTOR, "id_Usuario" => $_SESSION["user"], "nombre" => $datos["nombre"]);
            $this->refLog->registrarLog($parametros);
            
            return $id_autor;
        } catch (Exception $e) {
            throw new Exception("Autor-agregar: " . $e->getMessage());
        }
    }

    public function modificar($datos) {
        try {
            session_start();
            $parametros = array("nombreAutor" => $datos["nombre"], "id" => $datos["id"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::MODIFICAR_AUTOR, $parametros);
            
            unset($parametros);
            $parametros = array("accion" => Constantes::ACCION_MODIFICACION, "entidad" => Constantes::ENTIDAD_AUTOR, "id_Usuario" => $_SESSION["user"], "nombre" => $datos["nombre"]);
            $this->refLog->registrarLog($parametros);
            
        } catch (Exception $e) {
            throw new Exception("Autor-modificar: " . $e->getMessage());
        }
    }

    public function eliminar($datos) {
        try {
            session_start();
            $nombre = $this->traerNombre($datos["id"]);
            $parametros = array("id" => $datos["id"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::ELIMINAR_AUTOR, $parametros);
            
            unset($parametros);
            $parametros = array("accion" => Constantes::ACCION_BAJA, "entidad" => Constantes::ENTIDAD_AUTOR, "id_Usuario" => $_SESSION["user"], "nombre" => $nombre);
            $this->refLog->registrarLog($parametros);
            
        } catch (Exception $e) {
            throw new Exception("Autor-eliminar: " . $e->getMessage());
        }
    }

    private function ultimoID() {
        $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::ULTIMO_ID_AUTOR);
        $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $listado[0]["MAX(id_autor)"];
    }
    
    private function traerNombre($id) {
        $parametros = array("id" => $id);
        $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::NOMBRE_AUTORES, $parametros);
        $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $listado[0]["nombre"];
    }
    
    public function contarAutoresCargados($datos = null) {
        try {
            session_start();
            $resultado = null;
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::CONTAR_AUTORES_CARGADOS);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);

            return $listado[0]["autores"];
        } catch (Exception $e) {
            throw new Exception("Libro-ContarTodo: " . $e->getMessage());
        }
    }

}
