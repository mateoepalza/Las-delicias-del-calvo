<?php 

class AdministradorDAO{
    private $idAdministrador;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $foto;


    public function AdministradorDAO($idAdministardor = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $foto = ""){
        $this -> idAdministrador = $idAdministardor;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> foto = $foto;
    }

    /* 
    *   Functions
    */

    public function autenticar(){
        return "SELECT idAdministrador 
                FROM Administrador
                Where email = '" . $this -> correo . "' AND clave = '" . md5($this -> clave) . "'";
    }

    public function getInfoBasic(){
        return "SELECT idAdministrador, nombre, apellido, email, clave, foto 
                FROM Administrador
                WHERE idAdministrador = " . $this -> idAdministrador;
    }
}

?>