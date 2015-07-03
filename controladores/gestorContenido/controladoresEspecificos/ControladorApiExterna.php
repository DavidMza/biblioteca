<?php

require_once 'ControladorGeneral.php';
require_once 'Constantes.php';

class ControladorApiExterna extends ControladorGeneral {

    function __construct() {
        parent::__construct();
    }

    public function buscar($datos) {
        try {
            $uri = "http://isbndb.com/api/v2/json/NZ6JDLQG/books?q=".$datos["titulo"];
            $response = file_get_contents($uri);
            return $response;
        } catch (Exception $e) {
            throw new Exception("ApiExterna-buscar: " . $e->getMessage());
        }
    }

    public function agregar($datos) {
        
    }

    public function listar() {
        
    }

    public function modificar($datos) {
        
    }

//put your code here
}
