<?php

$url = $_SERVER['DOCUMENT_ROOT'] . "biblioteca/recursos/imagenes/libros";
$listadoFotos = array();
$directorio = opendir($url); //ruta actual
while ($archivo = readdir($directorio)) { //obtenemos un archivo y luego otro sucesivamente
    if (!is_dir($archivo)) {//verificamos si es o no un directorio 
        array_push($listadoFotos, 'recursos/imagenes/libros/' . $archivo);
    }
}
$value = "recursos/imagenes/libros/1435352189.png";
if (($key = array_search($value, $listadoFotos)) !== false) {
    echo 'true';
    echo $key;
    //unset($listadoFotos[$key]);
    array_splice($listadoFotos, $key, 1);
}else{
    echo 'false';
}
print_r($listadoFotos);



/*
$uri = "http://isbndb.com/api/v2/json/NZ6JDLQG/books?q=Alquimista";
$r = file_get_contents($uri);
$r = json_decode($r);
$retorno = array();
$i = 0;
foreach ($r->data as $value) {
    $retorno[$i]["titulo"] = $value->title_latin;
    $retorno[$i]["isbn"] = $value->isbn13;
    $retorno[$i]["autor"] = $value->author_data[0]->name;
    $retorno[$i]["editorial"] = $value->publisher_name;
    $i++;
}
print_r($retorno);*/