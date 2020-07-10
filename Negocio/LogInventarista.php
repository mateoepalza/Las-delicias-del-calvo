<?php 
require_once "Persistencia/Conexion.php";
require_once "Persistencia/LogInventaristaDAO.php";

class LogInventarista extends Log{

    private $LogInventaristaDAO; 

    public function LogInventarista($idLogInventarista = "", $fecha = "", $informacion = "", $accion = "", $browser = "", $os = "", $Inventarista = ""){

        parent::Log($idLogInventarista, $fecha, $informacion, $accion, $browser , $os, $Inventarista);
        $this -> LogInventaristaDAO = new LogInventaristaDAO($this -> idLog, $this -> fecha, $this -> informacion, $this -> accion, $this -> browser, $this -> os, $this -> user);

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