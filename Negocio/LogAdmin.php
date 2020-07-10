<?php 

require_once "Persistencia/Conexion.php";
require_once "Persistencia/LogAdminDAO.php";

class LogAdmin extends Log{

    private $LogAdminDAO; 

    public function LogAdmin($idLogAdmin = "", $fecha = "", $informacion = "", $accion = "", $browser = "", $os = "", $Administrador = ""){

        parent::Log($idLogAdmin, $fecha, $informacion, $accion, $browser , $os, $Administrador );
        $this -> LogAdminDAO = new LogAdminDAO($this -> idLog, $this -> fecha, $this -> informacion, $this -> accion, $this -> browser, $this -> os, $this -> user);
        
    }

    /**
     * Methods
     */

    /**
     * Crear texto de la creación del producto
     */
    
    public function insertar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> LogAdminDAO -> insertar());
        $this -> Conexion -> cerrar();
    }

}

?>