<?php

require_once 'ControladorGeneral.php';
require_once 'Constantes.php';

class ControladorAutor extends ControladorGeneral {

    function __construct() {
        parent::__construct();
    }

    public function listar() {
        try {
            session_start();
            
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_AUTORES);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Autor-listar: " . $e->getMessage());
        }
    }

    public function listarTodo() {
        try {
            session_start();
            $resultado = null;
            if ($_SESSION["tipo"] == Constantes::SUPER_ADMINISTRADOR) {
                $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_TODO_AUTORES);
            }else{
                $parametros = array("usuario" => $_SESSION["usuario"]);
                $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_TODO_AUTORES_X_USUARIO,$parametros);
            }
            
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Autor-listarTodo: " . $e->getMessage());
        }
    }
    
    public function listarLogs() {
        try {
            session_start();
            $resultado = null;
            if ($_SESSION["tipo"] == Constantes::SUPER_ADMINISTRADOR) {
                $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LOG_LISTAR_AUTORES);
            }
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Autor-listarLogs: " . $e->getMessage());
        }
    }

    public function agregar($datos) {
        try {
            //print_r($datos);
            session_start();
            $parametros = array("nombreAutor" => $datos["nombre"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::AGREGAR_AUTOR, $parametros);
            $id_autor = $this->ultimoID();
            $parametros = array("id" => $id_autor, "usuario" => $_SESSION["usuario"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LOG_AGREGAR_AUTORES, $parametros);
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
            $id_autor = $datos["id"];
            $parametros = array("id" => $id_autor, "usuario" => $_SESSION["usuario"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LOG_MODIFICAR_AUTORES, $parametros);
        } catch (Exception $e) {
            throw new Exception("Autor-modificar: " . $e->getMessage());
        }
    }

    public function eliminar($datos) {
        try {
            session_start();
            $parametros = array("id" => $datos["id"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::ELIMINAR_AUTOR, $parametros);
            $parametros = array("id" => $datos["id"], "usuario" => $_SESSION["usuario"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LOG_ELIMINAR_AUTORES, $parametros);
        } catch (Exception $e) {
            throw new Exception("Autor-eliminar: " . $e->getMessage());
        }
    }

    private function ultimoID() {
        $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::ULTIMO_ID_AUTOR);
        $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $listado[0]["MAX(id_autor)"];
    }
    
    public function contarAutoresCargados($datos = null) {
        try {
            session_start();
            $resultado = null;
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::CONTAR_AUTORES_CARGADOS);
            $retorno = array();
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            
            $retorno["cantTotal"] = $listado[0]["autores"];
            $resultado = null;
            $parametros = array("usuario" => $_SESSION["usuario"]);
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::CONTAR_AUTORES_CARGADOS_X_USUARIO, $parametros);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            
            $retorno["cantXusu"] = $listado[0]["autores"];
            //var_dump($listado);
            //print_r();
            return $retorno;
        } catch (Exception $e) {
            throw new Exception("Libro-CotarTodo: " . $e->getMessage());
        }
    }

}
