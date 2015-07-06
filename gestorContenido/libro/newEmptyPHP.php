<?php

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
print_r($retorno);