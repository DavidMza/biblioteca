<?php

require_once 'ControladorGeneral.php';

class ControladorClasificacion extends ControladorGeneral {

    public function agregar($datos) {
        try {
            session_start();
            $parametros = array("nombre" => $datos["nombre"],"padre" => $datos["padre"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::AGREGAR_CLASIFICACION, $parametros);
            $id_clasi = $this->ultimoID();
            $parametros = array("id" => $id_clasi, "usuario" => $_SESSION["usuario"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LOG_AGREGAR_CLASIFICACION, $parametros);
            return $id_clasi;
        } catch (Exception $e) {
            throw new Exception("Clasificacion-agregar: " . $e->getMessage());
        }
    }

    public function listar() {
        try {
            session_start();
            $resultado = null;
            if ($_SESSION["tipo"] == '2') {
                $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_CLASIFICACIONES);
            } else {
                $parametros = array("usuario" => $_SESSION["usuario"]);
                $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_CLASIFICACIONES_X_USUARIO, $parametros);
            }
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $listado[0]["parent"] = "#";
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Clasificacion-listar: " . $e->getMessage());
        }
    }
    
    public function listarLogs() {
        try {
            session_start();
            $resultado = null;
            if ($_SESSION["tipo"] == '2') {
                $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LOG_LISTAR_CLASIFICACIONES);
            }
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Clasificacion-listarLogs: " . $e->getMessage());
        }
    }

    public function modificar($datos) {
        try {
            session_start();
            $parametros = array("nombre" => $datos["nombre"],"padre" => $datos["padre"], "id" => $datos["id"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::MODIFICAR_CLASIFICACION, $parametros);
            $id_clasi = $datos["id"];
            $parametros = array("id" => $id_clasi, "usuario" => $_SESSION["usuario"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LOG_MODIFICAR_CLASIFICACION, $parametros);
        } catch (Exception $e) {
            throw new Exception("Clasificacion-modificar: " . $e->getMessage());
        }  
    }
    
    public function eliminar($datos) {
        try {
            session_start();
            $parametros = array("id" => $datos["id"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::ELIMINAR_CLASIFICACION, $parametros);
            $parametros = array("id" => $datos["id"], "usuario" => $_SESSION["usuario"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LOG_ELIMINAR_AUTORES, $parametros);
        } catch (Exception $e) {
            throw new Exception("Autor-eliminar: " . $e->getMessage());
        }
    }

    private function ultimoID() {
        $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::ULTIMO_ID_CLASIFICACION);
        $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $listado[0]["MAX(id_clasificacion)"];
    }
    
}
