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

    public function getInfoBasic(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> LogInventaristaDAO -> getInfoBasic());
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