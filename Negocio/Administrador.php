<?php 

    require_once "Persistencia/Conexion.php";
    require_once "Persistencia/AdministradorDAO.php";

class Administrador{
    private $idAdministrador;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $foto;
    private $AdministradorDAO;
    private $conexion;

    public function Administrador($idAdministardor = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $foto = ""){
        $this -> idAdministrador = $idAdministardor;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> foto = $foto;
        $this -> AdministradorDAO = new AdministradorDAO($idAdministardor, $nombre, $apellido, $correo, $clave, $foto);
        $this -> conexion = new Conexion();
    }
    /*
    *   Getters
    */
    public function getIdAdministrador(){
        return $this -> idAdministrador;
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

    /*
    *   Setters
    */
    public function setIdAdministrador($idAdministardor){
        $this -> idAdministrador = $idAdministardor;
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
    public function setConexion($Conexion){
        $this -> conexion = $Conexion;
    }
    /* 
    *   Functions
    */

    public function autenticar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> AdministradorDAO -> autenticar());
        //$this -> conexion -> cerrar();

        if($this -> conexion -> numFilas() == 1){
            $res = $this -> conexion -> extraer();
            $this -> idAdministrador = $res[0];
            return True;
        }else{
            return False;
        }
    }

    public function getInfoBasic(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> AdministradorDAO -> getInfoBasic() );
        $res = $this -> conexion -> extraer();
        /* Actualzar OBJ*/
        $this -> nombre = $res[1];
        $this -> apellido = $res[2];
        $this -> correo = $res[3];
        $this -> clave = $res[4];
        $this -> foto = $res[5];
        /* FIN Actualzar OBJ*/
        $this -> conexion -> cerrar();
    }
}

?>