<?php

require_once 'ControladorGeneral.php';

class ControladorUsuario extends ControladorGeneral {

    function __construct() {
        parent::__construct();
    }

    public function agregar($datos) {
        try {
            $parametros = array("nombre" => $datos["nombre"], "clave" => $datos["clave"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::AGREGAR_USUARIO, $parametros);
            $id_usuario = $this->ultimoID();
            return $id_usuario;
        } catch (Exception $e) {
            throw new Exception("Usuario-agregar: " . $e->getMessage());
        }
    }

    public function listar() {
        try {
            session_start();
            $resultado = null;
            if ($_SESSION["tipo"] == '2') {
                $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_USUARIOS);
            }
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Usuario-listar: " . $e->getMessage());
        }
    }

    public function listarTodo() {
        try {
            session_start();
            $resultado = null;
            if ($_SESSION["tipo"] == '2') {
                $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_TODO_USUARIOS);
            }
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Usuario-listarTodo: " . $e->getMessage());
        }
    }

    public function modificar($datos) {
        try {
            $parametros = array("nombre" => $datos["nombre"], "clave" => $datos["clave"], "id" => $datos["id"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::MODIFICAR_USUARIO, $parametros);
        } catch (Exception $e) {
            throw new Exception("Usuario-modificar: " . $e->getMessage());
        }
    }

    public function eliminar($datos) {
        try {
            $parametros = array("id" => $datos["id"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::ELIMINAR_USUARIO, $parametros);
        } catch (Exception $e) {
            throw new Exception("Usuario-eliminar: " . $e->getMessage());
        }
    }

    private function ultimoID() {
        $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::ULTIMO_ID_USUARIO);
        $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $listado[0]["MAX(id_usuario)"];
    }

}
