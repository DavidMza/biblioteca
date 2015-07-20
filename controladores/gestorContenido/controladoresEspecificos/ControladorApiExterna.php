<?php

require_once 'ControladorGeneral.php';
require_once 'Constantes.php';

class ControladorApiExterna extends ControladorGeneral {

    function __construct() {
        parent::__construct();
    }

    public function buscar($datos) {
        try {
            $uri = "http://isbndb.com/api/v2/json/NZ6JDLQG/books?q=" . $datos["titulo"];
            $r = file_get_contents($uri);
            $r = json_decode($r);
            $retorno = array();
            $i = 0;
            foreach ($r->data as $value) {
                unset($aux);
                $aux = array();
                //$retorno[$i] = array("isbn" =>$value->isbn13,"titulo" => $value->title_latin,"autor" =>$value->author_data[0]->name,"editorial" =>$value->publisher_name);
                $retorno[$i]["titulo"] = $value->title_latin;
                $retorno[$i]["isbn"] = $value->isbn13;
                if(isset($value->author_data[0]->name)){
                    $retorno[$i]["autor"] = $value->author_data[0]->name;
                }else{
                    $retorno[$i]["autor"] = "Sin Autor";
                }
                if($value->publisher_name != ""){
                    $retorno[$i]["editorial"] = $value->publisher_name;
                }else{
                    $retorno[$i]["editorial"] = "Sin Editorial";
                }
                //$retorno[$i] = $aux;
                $i++;
            }
            return $retorno;
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
