<?php

    function truncarString($str,$tam) {
        if(strlen($str)>$tam){
            return substr($str, 0, $tam)."...";
        }else{
            return $str;
        }
    }