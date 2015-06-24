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

    public function agregar($datos) {
        try {
            //print_r($datos);
            
            $data = base64_decode($datos["imagen"]);
            print_r(new DateTime());
            print_r($data);
            file_put_contents(__DIR__.'/../../../recursos/imagenes/libros/image.png', $data);
            return $datos["imagen"];
            //$file = $_FILES['imagen']['name'];
            //var_dump($_FILES);
            /*
            if ($file && move_uploaded_file($_FILES['imagen']['tmp_name'], 
                    "../../recursos/imagenes/libros/" . $file)) {
                sleep(3); //retrasamos la petición 3 segundos
                echo $file; //devolvemos el nombre del archivo para pintar la imagen
            }
            */


            //$parametros = array("urlFoto" => "urlFoto");
            //$this->refControladorPersistencia->ejecutarSentencia(DbSentencias::AGREGAR_FOTO, $parametros);
        } catch (Exception $e) {
            throw new Exception("Foto-agregar: " . $e->getMessage());
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

}
