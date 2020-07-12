<?php 

class LogClienteDAO{

    private $idLogCliente;
    private $fecha;
    private $informacion;
    private $accion;
    private $browser;
    private $os;
    private $Cliente;

    public function LogClienteDAO($idLogCliente = "", $fecha = "", $informacion = "", $accion = "", $browser = "", $os = "", $Cliente = ""){
        $this -> idLogCliente = $idLogCliente;
        $this -> fecha = $fecha;
        $this -> informacion = $informacion;
        $this -> accion = $accion;
        $this -> browser = $browser;
        $this -> os = $os;
        $this -> Cliente = $Cliente;
    }

    public function insertar(){
        return "INSERT INTO LogCliente (fecha, informacion, FK_idAccion, browser, os, FK_idCliente) 
                VALUES ('" . $this -> fecha . "', '" . $this -> informacion . "', '" . $this -> accion . "', '" . $this -> browser . "', '" . $this -> os . "', '" . $this -> Cliente . "')";
    }

    public function getInfoBasic(){
        return "SELECT idLogCliente, Fecha, informacion, FK_idAccion, browser, os, FK_idCliente, 2 
                FROM logCliente 
                WHERE idLogCliente = " . $this -> idLogCliente;
    }

}
?>