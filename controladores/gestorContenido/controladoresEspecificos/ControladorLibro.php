<?php

require_once 'ControladorGeneral.php';

class ControladorLibro extends ControladorGeneral {
    
    function __construct() {
        parent::__construct();
    }
    
    public function agregar($datos) {
        try {
            //print_r($datos);
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
            if ($_SESSION["tipo"] == '2') {
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

    private function ultimoID() {
        $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::ULTIMO_ID_LIBRO);
        $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $listado[0]["MAX(id_libro)"];
    }
    
}
