<?php 

require_once "Persistencia/Conexion.php";
require_once "Persistencia/LogDAO.php";

class Log{

    protected $idLog;
    protected $fecha;
    protected $informacion;
    protected $accion;
    protected $browser;
    protected $os;
    protected $user;

    protected $Conexion;
    private $LogAdminDAO; 

    public function Log($idLog = "", $fecha = "", $informacion = "", $accion = "", $browser = "", $os = "", $user = ""){
        $this -> idLog = $idLog;
        $this -> fecha = $fecha;
        $this -> informacion = $informacion;
        $this -> accion = $accion;
        $this -> browser = $browser;
        $this -> os = $os;
        $this -> user = $user;

        $this -> Conexion = new Conexion();
        $this -> LogAdminDAO = new LogDAO($this -> idLog, $this -> fecha, $this -> informacion, $this -> accion, $this -> browser, $this -> os, $this -> user);
    }

    /**
     * GETS
     */

    public function getIdLog(){
        return $this -> idLog;
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

    public function getUser(){
        return $this -> user;
    }

    /**
     * SETS
     */

    public function setIdLog($idLog){
        $this -> idLog = $idLog;
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
    
    public function setUser($user){
        $this -> user = $user;
    }
    /**
     * Methods
     */


}

?>