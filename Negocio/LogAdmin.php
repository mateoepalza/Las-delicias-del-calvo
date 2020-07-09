<?php 

require_once "Persistencia/Conexion.php";
require_once "Persistencia/LogAdminDAO.php";

class LogAdmin{

    private $idLogAdmin;
    private $fecha;
    private $informacion;
    private $accion;
    private $browser;
    private $os;
    private $Administrador;

    private $Conexion;
    private $LogAdminDAO; 

    public function LogAdmin($idLogAdmin = "", $fecha = "", $informacion = "", $accion = "", $browser = "", $os = "", $Administrador = ""){
        $this -> idLogAdmin = $idLogAdmin;
        $this -> fecha = $fecha;
        $this -> informacion = $informacion;
        $this -> accion = $accion;
        $this -> browser = $browser;
        $this -> os = $os;
        $this -> Administrador = $Administrador;

        $this -> Conexion = new Conexion();
        $this -> LogAdminDAO = new LogAdminDAO($this -> idLogAdmin, $this -> fecha, $this -> informacion, $this -> accion, $this -> browser, $this -> os, $this -> Administrador);
    }

    /**
     * GETS
     */

    public function getIdLogAdmin(){
        return $this -> idLogAdmin;
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

    public function getAdministrador(){
        return $this -> Administrador;
    }

    /**
     * SETS
     */

    public function setIdLogAdmin($idLogAdmin){
        $this -> idLogAdmin = $idLogAdmin;
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
    
    public function setAdministrador($Administrador){
        $this -> Administrador = $Administrador;
    }
    /**
     * Methods
     */

    /**
     * Crear texto de la creación del producto
     */
    
    public function insertar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> LogAdminDAO -> insertar() );
        $this -> Conexion -> cerrar();
    }

}

?>