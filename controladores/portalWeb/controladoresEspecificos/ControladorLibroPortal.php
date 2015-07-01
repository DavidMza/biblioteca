<?php

require_once 'ControladorGeneralPortal.php';

class ControladorLibroPortal extends ControladorGeneralPortal {

    function __construct() {
        parent::__construct();
    }

    public function lista($datos) {
        try {
            $parametros = array("id" => $datos["id"]);
            $resultado = $this->refControladorPersistencia->ejecutarSentencia(DBSentenciasPortal::TRAER_LIBRO, $parametros);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            //print_r($listado);
            return $listado;
        } catch (Exception $e) {
            throw new Exception("portal-listar-UN-libro: " . $e->getMessage());
        }
    }

    public function listarLibrosPortada($datos) {
        try {
            $tampag = $datos["tamanoPagina"]; //Cantidad de registros a mostrar pr pagina
            $pag = $datos["pagina"]; //Pagina que quiero mostrar
            $reg1 = ($pag - 1) * $tampag;
            $parametros = array("reg1" => $reg1, "tampag" => $tampag);
            $query = $this->reemplazarSignos($parametros);

            $resultado = $this->refControladorPersistencia->ejecutarSentencia($query);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);

            $total = $this->refControladorPersistencia->ejecutarSentencia(DBSentenciasPortal::TOTAL_LIBROS_PORTADA);
            $listado[] = $total->fetchAll(PDO::FETCH_ASSOC);

            return $listado;
        } catch (Exception $e) {
            throw new Exception("portal-listar-VARIOS-libro: " . $e->getMessage());
        }
    }

    public function listarLibrosPortadaBuscado($datos) {
        try {
            $tampag = $datos["tamanoPagina"]; //Cantidad de registros a mostrar pr pagina
            $pag = $datos["pagina"]; //Pagina que quiero mostrar
            $reg1 = ($pag - 1) * $tampag;
            $parametros = array("reg1" => $reg1, "tampag" => $tampag, "aBuscar" => $datos["buscar"]);

            $query = $this->reemplazarSignos($parametros, true);

            $resultado = $this->refControladorPersistencia->ejecutarSentencia($query);
            $listado = $resultado->fetchAll(PDO::FETCH_ASSOC);

            $query = $this->reemplazarSignos($parametros, true, true);
            $total = $this->refControladorPersistencia->ejecutarSentencia($query);
            $listado[] = $total->fetchAll(PDO::FETCH_ASSOC);

            return $listado;
        } catch (Exception $e) {
            throw new Exception("portal-listar-BUSCAR-libro: " . $e->getMessage());
        }
    }

    private function reemplazarSignos($p, $buscar = false, $buscarTotal = false) {
        if ($buscarTotal) {
            $query = str_replace("LIKE ?", "LIKE '" . $p["aBuscar"] . "%'", DBSentenciasPortal::TOTAL_LIBRO_ENCONTRADO);
            $query = str_replace("?, ?", $p["reg1"] . " , " . $p["tampag"], $query);
            return $query;
        }
        if ($buscar) {
            $query = str_replace("LIKE ?", "LIKE '" . $p["aBuscar"] . "%'", DBSentenciasPortal::BUSCAR_LIBRO);
            $query = str_replace("?, ?", $p["reg1"] . " , " . $p["tampag"], $query);
            return $query;
        }
        
        $query = str_replace("?, ?", $p["reg1"] . " , " . $p["tampag"], DBSentenciasPortal::LIBROS_PORTADA_LIMIT);
        return $query;
    }

}
