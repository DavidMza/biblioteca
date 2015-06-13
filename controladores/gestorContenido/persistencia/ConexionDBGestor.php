<?php
// Le puse ConexionDBGestor, porque netBeans se confunde y tomaba como referencia la conexion de PortalWeb (o.O)
class ConexionDBGestor {
    private $_conexion = null;
    private $_usuario = 'admin';
    private $_clave = '1234567';
    
    public function __construct() {
        $this->_conexion = new PDO("mysql:dbname=biblioteca;host=localhost", $this->_usuario, $this->_clave);
        $this->_conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    function get_conexion() {
        return $this->_conexion;
    }
}
