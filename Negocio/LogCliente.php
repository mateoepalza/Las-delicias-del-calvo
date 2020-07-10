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

}

?>