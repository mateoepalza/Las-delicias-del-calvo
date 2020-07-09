<?php 
require_once "Persistencia/Conexion.php";
require_once "Persistencia/LogInventaristaDAO.php";

class LogInventarista{

    private $idLogInventarista;
    private $fecha;
    private $informacion;
    private $accion;
    private $browser;
    private $os;
    private $Inventarista;

    private $Conexion;
    private $LogInventaristaDAO; 

    public function LogInventarista($idLogInventarista = "", $fecha = "", $informacion = "", $accion = "", $browser = "", $os = "", $Inventarista = ""){
        $this -> idLogInventarista = $idLogInventarista;
        $this -> fecha = $fecha;
        $this -> informacion = $informacion;
        $this -> accion = $accion;
        $this -> browser = $browser;
        $this -> os = $os;
        $this -> Inventarista = $Inventarista;

        $this -> Conexion = new Conexion();
        $this -> LogInventaristaDAO = new LogInventaristaDAO($this -> idLogInventarista, $this -> fecha, $this -> informacion, $this -> accion, $this -> browser, $this -> os, $this -> Inventarista);
    }

    /**
     * GETS
     */

    public function getIdLogInventarista(){
        return $this -> idLogInventarista;
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

    public function getInventarista(){
        return $this -> Inventarista;
    }

    /**
     * SETS
     */

    public function setIdLogInventarista($idLogInventarista){
        $this -> idLogInventarista = $idLogInventarista;
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
    
    public function setInventarista($Inventarista){
        $this -> Inventarista = $Inventarista;
    }
    /**
     * Methods
     */

    /**
     * Crear texto de la creación del producto
     */
    
    public function insertar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> LogInventaristaDAO -> insertar() );
        $this -> Conexion -> cerrar();
    }

}

?>