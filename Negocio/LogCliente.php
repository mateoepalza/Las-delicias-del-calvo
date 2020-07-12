<?php 
require_once "Persistencia/Conexion.php";
require_once "Persistencia/LogClienteDAO.php";

class LogCliente extends Log{

    private $LogClienteDAO; 

    public function LogCliente($idLogCliente = "", $fecha = "", $informacion = "", $accion = "", $browser = "", $os = "", $Cliente = ""){

        parent::Log($idLogCliente, $fecha, $informacion, $accion, $browser , $os, $Cliente);
        $this -> LogClienteDAO = new LogClienteDAO($this -> idLog, $this -> fecha, $this -> informacion, $this -> accion, $this -> browser, $this -> os, $this -> user);

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

    public function getInfoBasic(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> LogClienteDAO -> getInfoBasic());
        $res = $this -> Conexion -> extraer();

        $this -> idLog = $res[0] ;
        $this -> fecha = $res[1];
        $this -> informacion = $res[2];
        $this -> accion = $res[3];
        $this -> browser = $res[4];
        $this -> os = $res[5];
        $this -> user = $res[6];
        $this -> tipo = $res[7];
        
        $this -> Conexion -> cerrar();
    }

}

?>