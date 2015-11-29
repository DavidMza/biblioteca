<?php

require_once 'ControladorGeneral.php';
require_once 'ControladorFoto.php';
require_once 'ControladorLog.php';

class ControladorLibro extends ControladorGeneral {

    private $refLog;
    
    function __construct() {
        parent::__construct();
        $this->refLog = new ControladorLog();
    }

    public function agregar($datos) {
        try {
            $contrFoto = new ControladorFoto();
            $nombreFoto = $contrFoto->guardarFoto($datos["fotos"]);
            session_start();
            $destacado = null;
            if ($datos["destacado"] == "true") {
                $destacado = 1;
            } else {
                $destacado = 0;
            }
            $disponible = null;
            if ($datos["disponible"] == "true") {
                $disponible = 1;
            } else {
                $disponible = 0;
            }
            $parametros = array("titulo" => $datos["titulo"], "isbn" => $datos["isbn"], "paginas" => $datos["paginas"], "idioma" => $datos["idioma"], "publicacion" => $datos["publicacion"], "disponible" => $disponible, "destacado" => $destacado, "autor" => $datos["autor"], "editorial" => $datos["editorial"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::AGREGAR_LIBRO, $parametros);
            $id_ = $this->ultimoID();

            $parametros = array("ruta" => "recursos/imagenes/libros/" . $nombreFoto, "idlibro" => $id_);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::AGREGAR_FOTO, $parametros);

            foreach ($datos["clasificaciones"] as $value) {
                $parametros = array("clasificacion" => $value, "idlibro" => $id_);
                $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::AGREGAR_LIBRO_CLASIFICACION, $parametros);
            }

            foreach ($datos["caracteristicas"] as $value) {
                $parametros = array("caracteristicas" => $value, "idlibro" => $id_);
                $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::AGREGAR_LIBRO_CARACTERISTICA, $parametros);
            }

            unset($parametros);
            $parametros = array("accion" => Constantes::ACCION_ALTA, "entidad" => Constantes::ENTIDAD_LIBRO, "id_Usuario" => $_SESSION["user"], "nombre" => $datos["titulo"]);
            $this->refLog->registrarLog($parametros);
            
            return $id_;
        } catch (Exception $e) {
            throw new Exception("Libro-agregar: " . $e->getMessage());
        }
    }

    public function listar() {
        try {
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_LIBROS);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Libro-listar: " . $e->getMessage());
        }
    }

    public function listarLog() {
        try {
            unset($parametros);
            $parametros = array("entidad" => Constantes::ENTIDAD_LIBRO);
            $listado = $this->refLog->listarLog($parametros);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Libro-listarLog: " . $e->getMessage());
        }
    }

    public function modificar($datos) {
        try {

            $contrFoto = new ControladorFoto();
            $parametros = array("id" => $datos["id"], "fotos" => $datos["fotos"]);
            $contrFoto->modificar($parametros);
            session_start();
            $destacado = null;
            if ($datos["destacado"] == "true") {
                $destacado = 1;
            } else {
                $destacado = 0;
            }
            $disponible = null;
            if ($datos["disponible"] == "true") {
                $disponible = 1;
            } else {
                $disponible = 0;
            }
            $parametros = array("titulo" => $datos["titulo"], "isbn" => $datos["isbn"], "paginas" => $datos["paginas"], "idioma" => $datos["idioma"], "publicacion" => $datos["publicacion"], "disponible" => $disponible, "destacado" => $destacado, "autor" => $datos["autor"], "editorial" => $datos["editorial"], "id" => $datos["id"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::MODIFICAR_LIBRO, $parametros);
            $id_ = $datos["id"];

            $parametros = array("id" => $datos["id"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::ELIMINAR_LIBRO_CLASIFICACION, $parametros);
            foreach ($datos["clasificaciones"] as $value) {
                $parametros = array("clasificacion" => $value, "idlibro" => $id_);
                $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::AGREGAR_LIBRO_CLASIFICACION, $parametros);
            }

            $parametros = array("id" => $datos["id"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::ELIMINAR_LIBRO_CARACTERISTICA, $parametros);
            foreach ($datos["caracteristicas"] as $value) {
                $parametros = array("caracteristicas" => $value, "idlibro" => $id_);
                $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::AGREGAR_LIBRO_CARACTERISTICA, $parametros);
            }

            unset($parametros);
            $parametros = array("accion" => Constantes::ACCION_MODIFICACION, "entidad" => Constantes::ENTIDAD_LIBRO, "id_Usuario" => $_SESSION["user"], "nombre" => $datos["titulo"]);
            $this->refLog->registrarLog($parametros);
            
        } catch (Exception $e) {
            throw new Exception("Libro-modificar: " . $e->getMessage());
        }
    }

    public function eliminar($datos) {
        try {
            session_start();
            $nombre = $this->traerNombre($datos["id"]);
            $parametros = array("id" => $datos["id"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::ELIMINAR_LIBRO, $parametros);
            
            unset($parametros);
            $parametros = array("accion" => Constantes::ACCION_BAJA, "entidad" => Constantes::ENTIDAD_LIBRO, "id_Usuario" => $_SESSION["user"], "nombre" => $nombre);
            $this->refLog->registrarLog($parametros);
            
        } catch (Exception $e) {
            throw new Exception("Libro-eliminar: " . $e->getMessage());
        }
    }

    private function ultimoID() {
        $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::ULTIMO_ID_LIBRO);
        $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $listado[0]["MAX(id_libro)"];
    }
    
    private function traerNombre($id) {
        $parametros = array("id" => $id);
        $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::NOMBRE_LIBROS, $parametros);
        $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $listado[0]["nombre"];
    }

    public function contarLibrosCargados($datos = null) {
        try {
            session_start();
            $resultado = null;
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::CONTAR_LIBROS_CARGADOS);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);

            return $listado[0]["libros"];
        } catch (Exception $e) {
            throw new Exception("Libro-Contar: " . $e->getMessage());
        }
    }
}
