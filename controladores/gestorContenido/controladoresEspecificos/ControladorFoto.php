<?php

require_once 'ControladorGeneral.php';

class ControladorFoto extends ControladorGeneral {

    function __construct() {
        parent::__construct();
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
            $parametros = array("urlFoto" => "urlFoto", "id" => "idFoto");
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::MODIFICAR_FOTO, $parametros);
        } catch (Exception $e) {
            throw new Exception("Foto-modificar: " . $e->getMessage());
        }
    }

    public function eliminar($datos) {
        $tabla = "fotos";
        $nombreID = "id_foto";
        $parametros = array("tabla" => $tabla, "nombreID" => $nombreID, "id" => $datos["id_editorial"]);
        parent::eliminar($parametros);
    }

    public function agregar($datos) {
        
    }

}
