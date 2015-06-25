<?php

require_once 'ConexionDBPortal.php';

class ControladorPersistencia {

    private $_conexion;
    private static $instancia;

    public function __construct() {
        $db = new ConexionDBPortal();
        $this->_conexion = $db->get_conexion();
    }

    public static function obtenerCP() {
        if (!self::$instancia instanceof self) {
            self::$instancia = new self;
        }
        return self::$instancia;
    }

    public function iniciarTransaccion() {
        $this->_conexion->beginTransaction();
    }

    public function confirmarTransaccion() {
        $this->_conexion->commit();
    }

    public function rollBackTransaccion() {
        $this->_conexion->rollBack();
    }

    public function cerrarConexion() {
        $this->_conexion = null;
    }

    public function ejecutarSentencia($query, $parametros = null) {
        $statement = $this->_conexion->prepare($query);
        if ($parametros) {
            $index = 1;
            foreach ($parametros as $key => $parametro) {
                $statement->bindValue($index, $parametro);
                $index ++;
            }
        }
        $statement->execute();
        return $statement;
    }

}
