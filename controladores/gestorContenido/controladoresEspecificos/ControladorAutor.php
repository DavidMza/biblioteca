<?php
require_once 'ControladorGeneral.php';

class ControladorAutor extends ControladorGeneral {
    function __construct() {
        parent::__construct();
    }
    
    public function listar() {
        try {
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_AUTORES);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Autor-listar: " . $e->getMessage());
        }
    }
    
    public function listarTodo() {
        try {
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LISTAR_TODO_AUTORES);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("Autor-listarTodo: " . $e->getMessage());
        }
    }
    
    public function agregar($datos) {
        try{
            $parametros = array("nombreAutor" => $datos["nombre"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::AGREGAR_AUTOR, $parametros);
        }  catch (Exception $e){
            throw new Exception("Autor-agregar: " . $e->getMessage());
        }
    }

    public function modificar($datos) {
        try{
            $parametros = array("nombreAutor" => $datos["nombre"], "id" => $datos["id"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::MODIFICAR_AUTOR, $parametros);
        }  catch (Exception $e){
            throw new Exception("Autor-modificar: " . $e->getMessage());
        }    
    }

    public function eliminar($datos) {
        $tabla = "autores";
        $nombreID = "id_autor";
        $parametros = array("tabla" => $tabla, "nombreID" => $nombreID , "id" => $datos["id"]);
        parent::eliminar($parametros);
    }
}
