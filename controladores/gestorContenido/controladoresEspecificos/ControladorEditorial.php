<?php
require_once 'ControladorGeneral.php';
require_once 'Controlador_LogEditoriales.php';
class ControladorEditorial extends ControladorGeneral{
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
        try{
            session_start();
            $parametros = array("nombreEditorial" => $datos["nombre"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::AGREGAR_EDITORIAL, $parametros);
            //Rescato la editorial insertada
            unset($parametros);
            $ultimaEditorial = $this->ultimoID();
            $parametros = array("id_Editorial" => $ultimaEditorial, "id_Usuario" => $_SESSION["usuario"]);
            
            $this->refLog = new Controlador_LogEditoriales($parametros);
            $this->refLog->agregar();
            
        }  catch (Exception $e){
            throw new Exception("Editorial-agregar: " . $e->getMessage());
        }
    }

    public function modificar($datos) {
        try{
            session_start();
            $parametros = array("nombreEditorial" => $datos["nombre"], "id" => $datos["id"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::MODIFICAR_EDITORIAL, $parametros);
            
            unset($parametros);
            $parametros = array("id_Editorial" => $datos["id"], "id_Usuario" => $_SESSION["usuario"]);
            
            $this->refLog = new Controlador_LogEditoriales($parametros);
            $this->refLog->modificar();
            
        }  catch (Exception $e){
            throw new Exception("Editorial-modificar: " . $e->getMessage());
        }    
    }

    public function eliminar($datos) {
        try {
            session_start();
            $parametros = array("id" => $datos["id"]);
            $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::ELIMINAR_EDITORIAL, $parametros);
            
            unset($parametros);
            $parametros = array("id_Editorial" => $datos["id"], "id_Usuario" => $_SESSION["usuario"]);
            
            $this->refLog = new Controlador_LogEditoriales($parametros);
            $this->refLog->eliminar();
        } catch (Exception $e) {
            throw new Exception("Editorlal-eliminar: " . $e->getMessage());
        }
    }
    
    private function ultimoID() {
        $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::ULTIMO_ID_EDITORIAL);
        $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $listado[0]["ultimo"];
    }


}
