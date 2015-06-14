<?php

require_once 'ControladorGeneral.php';

class ControladorLogin extends ControladorGeneral {

    function __construct() {
        parent::__construct();
    }

    public function login($datos) {
        try {
            $parametros = array("usuario" => $datos["usuario"]);
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DbSentencias::LOGIN, $parametros);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            if (count($listado) == 1) {
                if ($listado[0]["clave_usuario"] == $datos["clave"]) {
                    unset($listado[0]["clave_usuario"]);
                    session_start();
                    $_SESSION["usuario"] = $listado[0]["nombre"];
                    $_SESSION["tipo"] = $listado[0]["value"];
                    return $listado;
                } else {
                    throw new Exception("Contraseña Incorrecta");
                }
            } else {
                throw new Exception("Nombre de Usuario Incorrecto");
            }
        } catch (Exception $e) {
            throw new Exception("login: " . $e->getMessage());
        }
    }
    
    public function logout($datos) {
        try {
            session_start();
            if (!session_destroy()) {
               throw new Exception("No se pudo cerrar la session");
            }
        } catch (Exception $e) {
            throw new Exception("logout: " . $e->getMessage());
        }
    }

    public function agregar($datos) {
        throw new Exception("Login-agregar: No Hago Nada");
    }

    public function listar() {
        throw new Exception("Login-listar: No Hago Nada");
    }

    public function modificar($datos) {
        throw new Exception("Login-modificar: No Hago Nada");
    }

}
