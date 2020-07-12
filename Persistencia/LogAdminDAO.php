<?php 

class LogAdminDAO{

    private $idLogAdmin;
    private $fecha;
    private $informacion;
    private $accion;
    private $browser;
    private $os;
    private $Administrador;

    public function LogAdminDAO($idLogAdmin = "", $fecha = "", $informacion = "", $accion = "", $browser = "", $os = "", $Administrador = ""){
        $this -> idLogAdmin = $idLogAdmin;
        $this -> fecha = $fecha;
        $this -> informacion = $informacion;
        $this -> accion = $accion;
        $this -> browser = $browser;
        $this -> os = $os;
        $this -> Administrador = $Administrador;
    }

    public function insertar(){
        return "INSERT INTO LogAdministrador (fecha, informacion, FK_idAccion, browser, os, FK_idAdministrador) 
                VALUES ('" . $this -> fecha . "', '" . $this -> informacion . "', '" . $this -> accion . "', '" . $this -> browser . "', '" . $this -> os . "', '" . $this -> Administrador . "')";
    }

    public function getInfoBasic(){
        return "SELECT idLogAdministrador, Fecha, informacion, FK_idAccion, browser, os, FK_idAdministrador, 1 
                FROM logAdministrador 
                WHERE idLogAdministrador = " . $this -> idLogAdmin;
    }

}
?>