<?php 

require_once "Persistencia/Conexion.php";
require_once "Persistencia/ClienteDAO.php";

class Cliente{
    private $idCliente;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $foto;
    private $estado;
    private $activacion;
    private $ClienteDAO;
    private $conexion;

    public function Cliente($idCliente = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $foto = "", $estado = "", $activacion = ""){
        $this -> idCliente = $idCliente;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> foto = $foto;
        $this -> estado = $estado;
        $this -> activacion = $activacion;
        $this -> ClienteDAO = new ClienteDAO($idCliente, $nombre, $apellido, $correo, $clave, $foto, $estado, $activacion);
        $this -> conexion = new Conexion();
    }
    /*
    *   Getters
    */
    public function getIdCliente(){
        return $this -> idCliente;
    }

    public function getNombre(){
        return $this -> nombre;
    }

    public function getApellido(){
        return $this -> apellido;
    }

    public function getCorreo(){
        return $this -> correo;
    }

    public function getClave(){
        return $this -> clave;
    }

    public function getFoto(){
        return $this -> Foto;
    }
    public function getEstado(){
        return $this -> estado;
    }
    public function getActivacion(){
        return $this -> Activacion;
    }

    /*
    *   Setters
    */
    public function setIdCliente($idCliente){
        $this -> idCliente = $idCliente;
    }

    public function setNombre($nombre){
        $this -> nombre = $nombre;
    }

    public function setApellido($apellido){
        $this -> apellido = $apellido;
    }

    public function setCorreo($correo){
        $this -> correo = $correo;
    }

    public function setClave($clave){
        $this -> clave = $clave;
    }

    public function setFoto($foto){
        $this -> Foto = $foto;
    }
    public function setEstado($estado){
        $this -> Estado = $estado;
    }
    public function setActivacion($activacion){
        $this -> Activacion = $activacion;
    }
    /* 
    *   Functions
    */
    public function autenticar(){
        $this -> conexion -> abrir();
        echo $this -> ClienteDAO -> autenticar();
        $this -> conexion -> ejecutar( $this -> ClienteDAO -> autenticar());
        if($this -> conexion -> numFilas() == 1){
            $res = $this -> conexion -> extraer();
            var_dump($res);
            $this -> idCliente = $res[0];
            $this -> nombre = $res[1];
            $this -> apellido = $res[2];
            $this -> foto = $res[3];
            $this -> estado = $res[4];
            $this -> activacion = $res[5];

            return True;
        }else{
            return False;
        }
        $this -> conexion -> cerrar();
    }
}
?>