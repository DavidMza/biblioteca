<?php

$uri = "http://isbndb.com/api/v2/json/NZ6JDLQG/books?q=Alquimista";
$response = file_get_contents($uri);
print_r($response);