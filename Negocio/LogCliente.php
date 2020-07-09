<?php 
require_once "Persistencia/Conexion.php";
require_once "Persistencia/LogClienteDAO.php";

class LogCliente{

    private $idLogCliente;
    private $fecha;
    private $informacion;
    private $accion;
    private $browser;
    private $os;
    private $Cliente;

    private $Conexion;
    private $LogClienteDAO; 

    public function LogCliente($idLogCliente = "", $fecha = "", $informacion = "", $accion = "", $browser = "", $os = "", $Cliente = ""){
        $this -> idLogCliente = $idLogCliente;
        $this -> fecha = $fecha;
        $this -> informacion = $informacion;
        $this -> accion = $accion;
        $this -> browser = $browser;
        $this -> os = $os;
        $this -> Cliente = $Cliente;

        $this -> Conexion = new Conexion();
        $this -> LogClienteDAO = new LogClienteDAO($this -> idLogCliente, $this -> fecha, $this -> informacion, $this -> accion, $this -> browser, $this -> os, $this -> Cliente);
    }

    /**
     * GETS
     */

    public function getIdLogCliente(){
        return $this -> idLogCliente;
    }

    public function getFecha(){
        return $this -> fecha;
    }

    public function getInformacion(){
        return $this -> informacion;
    }

    public function getAccion(){
        return $this -> accion;
    }

    public function getBrowser(){
        return $this -> browser;
    }

    public function getOs(){
        return $this -> os;
    }

    public function getCliente(){
        return $this -> Cliente;
    }

    /**
     * SETS
     */

    public function setIdLogCliente($idLogCliente){
        $this -> idLogCliente = $idLogCliente;
    }

    public function setFecha($fecha){
        $this -> fecha = $fecha;
    }

    public function setInformacion($informacion){
        $this -> informacion = $informacion;
    }

    public function setAccion($accion){
        $this -> accion = $accion;
    }

    public function setBrowser($browser){
        $this -> browser = $browser;
    }

    public function setOs($os){
        $this -> os = $os;
    }
    
    public function setCliente($Cliente){
        $this -> Cliente = $Cliente;
    }
    /**
     * Methods
     */

    /**
     * Crear texto de la creación del producto
     */
    
    public function insertar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> LogClienteDAO -> insertar() );
        $this -> Conexion -> cerrar();
    }

}

?>