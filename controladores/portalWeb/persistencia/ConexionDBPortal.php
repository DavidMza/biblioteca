<?php

class ConexionDBPortal {
    private $_conexion = null;
    private $_usuario = 'cliente';
    private $_clave = '1234567';
    
    public function __construct() {
        $this->_conexion = new PDO("mysql:dbname=biblioteca;host=localhost", $this->_usuario, $this->_clave);
        $this->_conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    function get_conexion() {
        return $this->_conexion;
    }
}
