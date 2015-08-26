<?php

require_once 'ControladorGeneral.php';
require_once 'ControladorLogEditoriales.php';

class ControladorEditorial extends ControladorGeneral {

    private $refLog;

    function __construct() {
        parent::__construct();
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

    public function listarTodo() {
        try {
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_TODO_EDITORIALES);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Editorial-listar: " . $e->getMessage());
        }
    }

    public function agregar($datos) {
        try {
            session_start();
            $parametros = array("nombreEditorial" => $datos["nombre"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::AGREGAR_EDITORIAL, $parametros);
            unset($parametros);
            //Rescato la editorial insertada
            $idUltimaEditorial = $this->ultimoID();

            $parametros = array("id_Editorial" => $idUltimaEditorial, "nuevo_nombre_Editorial" => $datos["nombre"], "id_Usuario" => $_SESSION["user"]);
            //print_r($_SESSION);
            $this->refLog = new Controlador_LogEditoriales($parametros);
            $this->refLog->agregar();

            return $idUltimaEditorial;
        } catch (Exception $e) {
            throw new Exception("Editorial-agregar: " . $e->getMessage());
        }
    }

    public function modificar($datos) {
        try {
            session_start();
            //Primero rescato el nombre de la editorial que voy a modificar
            $nombreEditorialAnterior = $this->traerNombreEditorial($datos["id"]);
            //Cargo los parametros y aplico la modificacion
            $parametros = array("nombreEditorial" => $datos["nombre"], "id" => $datos["id"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::MODIFICAR_EDITORIAL, $parametros);

            unset($parametros);
            $parametros = array("id_Editorial" => $datos["id"],
                "id_Usuario" => $_SESSION["user"],
                "nuevo_nombre_Editorial" => $datos["nombre"],
                "anterior_nombre_Editorial" => $nombreEditorialAnterior
            );

            $this->refLog = new Controlador_LogEditoriales($parametros);
            $this->refLog->modificar();
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
            $parametros = array("id_Editorial" => $datos["id"],
                "id_Usuario" => $_SESSION["user"],
                "anterior_nombre_Editorial" => $nombreEditorialAnterior
            );

            $this->refLog = new Controlador_LogEditoriales($parametros);
            $this->refLog->eliminar();
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

    public function contarAutoresCargados($datos = null) {
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
