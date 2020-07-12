<?php 

require_once "Persistencia/Conexion.php";
require_once "Persistencia/LogInventaristaDAO.php";

class LogInventaristaDAO{

    private $idLogInventarista;
    private $fecha;
    private $informacion;
    private $accion;
    private $browser;
    private $os;
    private $Inventarista;

    public function LogInventaristaDAO($idLogInventarista = "", $fecha = "", $informacion = "", $accion = "", $browser = "", $os = "", $Inventarista = ""){
        $this -> idLogInventarista = $idLogInventarista;
        $this -> fecha = $fecha;
        $this -> informacion = $informacion;
        $this -> accion = $accion;
        $this -> browser = $browser;
        $this -> os = $os;
        $this -> Inventarista = $Inventarista;
    }

    public function insertar(){
        return "INSERT INTO LogInventarista (fecha, informacion, FK_idAccion, browser, os, FK_idInventarista) 
                VALUES ('" . $this -> fecha . "', '" . $this -> informacion . "', '" . $this -> accion . "', '" . $this -> browser . "', '" . $this -> os . "', '" . $this -> Inventarista . "')";
    }

    public function getInfoBasic(){
        return "SELECT idLogInventarista, Fecha, informacion, FK_idAccion, browser, os, FK_idInventarista, 3 
                FROM logInventarista 
                WHERE idLogInventarista = " . $this -> idLogInventarista;
    }
}
?>