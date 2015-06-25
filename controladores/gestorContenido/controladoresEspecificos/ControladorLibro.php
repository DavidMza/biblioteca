<?php

require_once 'ControladorGeneral.php';
require_once 'ControladorFoto.php';
require_once 'Constantes.php';

class ControladorLibro extends ControladorGeneral {
    
    function __construct() {
        parent::__construct();
    }
    
    public function agregar($datos) {
        try {
            $contrFoto = new ControladorFoto();
            $nombreFoto = $contrFoto->guardarFoto($datos["fotos"]);
            print_r($nombreFoto);
            
            //echo explode(".", $_SERVER["REQUEST_TIME_FLOAT"])[0];
            throw new Exception();
            session_start();
            $destacado = null;
            if ($datos["destacado"] == "true") {
                $destacado = 1;
            }else{
                $destacado = 0;
            }
            $disponible = null;
            if ($datos["disponible"] == "true") {
                $disponible = 1;
            }else{
                $disponible = 0;
            }
            $parametros = array("titulo" => $datos["titulo"],"isbn" => $datos["isbn"],"paginas" => $datos["paginas"],"idioma" => $datos["idioma"],"publicacion" => $datos["publicacion"],"disponible" => $disponible,"destacado" => $destacado,"autor" => $datos["autor"],"editorial" => $datos["editorial"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::AGREGAR_LIBRO, $parametros);
            $id_ = $this->ultimoID();
            $parametros = array("id" => $id_, "usuario" => $_SESSION["usuario"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LOG_AGREGAR_LIBROS, $parametros);
            return $id_;
        } catch (Exception $e) {
            throw new Exception("Libro-agregar: " . $e->getMessage());
        }
    }

    public function listar() {
        try {
            session_start();
            $resultado = null;
            if ($_SESSION["tipo"] == Constantes::SUPER_ADMINISTRADOR) {
                $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_LIBROS);
            }else{
                $parametros = array("usuario" => $_SESSION["usuario"]);
                $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_LIBROS_X_USUARIO,$parametros);
            }
            
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Libro-listar: " . $e->getMessage());
        }
    }
    
    public function listarTodo() {
        try {
            session_start();
            $resultado = null;
            if ($_SESSION["tipo"] == Constantes::SUPER_ADMINISTRADOR) {
                $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_TODO_LIBROS);
            }else{
                $parametros = array("usuario" => $_SESSION["usuario"]);
                $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_TODO_LIBROS_X_USUARIO,$parametros);
            }
            
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Libro-listarTodo: " . $e->getMessage());
        }
    }
    
    public function listarLogs() {
        try {
            session_start();
            $resultado = null;
            if ($_SESSION["tipo"] == Constantes::SUPER_ADMINISTRADOR) {
                $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LOG_LISTAR_LIBROS);
            }
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Libro-listarLogs: " . $e->getMessage());
        }
    }

    public function modificar($datos) {
        try {
            session_start();
            $destacado = null;
            if ($datos["destacado"] == "true") {
                $destacado = 1;
            }else{
                $destacado = 0;
            }
            $disponible = null;
            if ($datos["disponible"] == "true") {
                $disponible = 1;
            }else{
                $disponible = 0;
            }
            $parametros = array("titulo" => $datos["titulo"],"isbn" => $datos["isbn"],"paginas" => $datos["paginas"],"idioma" => $datos["idioma"],"publicacion" => $datos["publicacion"],"disponible" => $disponible,"destacado" => $destacado,"autor" => $datos["autor"],"editorial" => $datos["editorial"],"id" => $datos["id"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::MODIFICAR_LIBRO, $parametros);
            $id_ = $datos["id"];
            $parametros = array("id" => $id_, "usuario" => $_SESSION["usuario"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LOG_MODIFICAR_LIBROS, $parametros);
        } catch (Exception $e) {
            throw new Exception("Libro-modificar: " . $e->getMessage());
        }
    }
    
    public function eliminar($datos) {
        try {
            session_start();
            $parametros = array("id" => $datos["id"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::ELIMINAR_LIBRO, $parametros);
            $parametros = array("id" => $datos["id"], "usuario" => $_SESSION["usuario"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LOG_ELIMINAR_AUTORES, $parametros);
        } catch (Exception $e) {
            throw new Exception("Libro-eliminar: " . $e->getMessage());
        }
    }

    private function ultimoID() {
        $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::ULTIMO_ID_LIBRO);
        $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $listado[0]["MAX(id_libro)"];
    }
    
}
