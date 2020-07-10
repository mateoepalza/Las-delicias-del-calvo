<?php 

class LogDAO{

    private $idLog;
    private $fecha;
    private $informacion;
    private $accion;
    private $browser;
    private $os;
    private $user;

    public function LogDAO($idLog = "", $fecha = "", $informacion = "", $accion = "", $browser = "", $os = "", $user = ""){
        $this -> idLog = $idLog;
        $this -> fecha = $fecha;
        $this -> informacion = $informacion;
        $this -> accion = $accion;
        $this -> browser = $browser;
        $this -> os = $os;
        $this -> user = $user;
    }
}
?>