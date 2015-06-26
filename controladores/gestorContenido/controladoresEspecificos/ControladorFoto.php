<?php

require_once 'ControladorGeneral.php';

class ControladorFoto extends ControladorGeneral {

    function __construct() {
        parent::__construct();
    }
    
    public function buscar($datos) {
        try {
            $parametros = array("id" => $datos["id"]);
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::BUSCAR_FOTO,$parametros);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Foto-buscar: " . $e->getMessage());
        }
    }

    public function listar() {
        try {
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_FOTO_ORDER_LIBROS);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Foto-listar: " . $e->getMessage());
        }
    }

    public function guardarFoto($fotoB64) {
        try {
            //print_r($fotoB64);
            $data = base64_decode($fotoB64[0]);
            $nombre = explode(".", $_SERVER["REQUEST_TIME_FLOAT"])[0] . ".png";
            file_put_contents(__DIR__ . '/../../../recursos/imagenes/libros/' . $nombre, $data);
            return $nombre;
        } catch (Exception $e) {
            throw new Exception("Foto-guardar: " . $e->getMessage());
        }
    }

    public function modificar($datos) {
        try {
            $parametros = array("id" => $datos["id"]);
            $FotoVieja = $this->buscar($parametros);
            $this->borrarFoto($FotoVieja[0]["ruta"]);
            $nombreFotoNueva = $this->guardarFoto($datos["fotos"]);
            
            $parametros = array("ruta" => "recursos/imagenes/libros/" . $nombreFotoNueva, "id" => $FotoVieja[0]["id"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::MODIFICAR_FOTO, $parametros);
        } catch (Exception $e) {
            throw new Exception("Foto-modificar: " . $e->getMessage());
        }
    }

    public function borrarFoto($datos) {
        unlink($_SERVER["DOCUMENT_ROOT"]."biblioteca/".$datos);
    }

    public function agregar($datos) {
        
    }

}
