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

    public function checkClave(){
        return "SELECT idAdministrador
                FROM Administrador
                WHERE idAdministrador = '" . $this -> idAdministrador . "' AND clave = '" . md5($this -> clave) . "'";
    }

    public function actualizarClave($nuevaClave){
        return "UPDATE Administrador
                SET
                    clave = '" . md5($nuevaClave) . "'
                WHERE idAdministrador = " . $this -> idAdministrador;
    }

    public function actualizarAdministrador(){
        return "UPDATE Administrador
                SET 
                    nombre = '" . $this -> nombre . "',
                    apellido = '" . $this -> apellido . "',
                    email = '" . $this -> correo. "',
                    foto = '" . $this -> foto. "'
                WHERE idAdministrador = " . $this -> idAdministrador;
    }

    public function existeCorreo(){
        return "SELECT idAdministrador
                FROM Administrador
                WHERE email = '" . $this -> correo . "'";
    }

    public function existeNuevoCorreo($correo){
        return "SELECT idAdministrador
                FROM Administrador
                WHERE email = '" . $correo . "'";
    }

    public function buscarPaginado($pag, $cant){
        return "SELECT idAdministrador, nombre, apellido, email 
                FROM Administrador
                LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
    }

    public function buscarCantidad(){
        return "SELECT count(*) 
                FROM Administrador";
    }

    public function insertar(){
        return "INSERT INTO Administrador (nombre, apellido, email, clave) 
                VALUES ('" . $this -> nombre . "', '" . $this -> apellido . "', '" . $this -> correo . "', '" . md5($this -> clave) . "')";
    }

    public function filtroPaginado($str, $pag, $cant){
        return "SELECT idAdministrador, nombre, apellido, email 
                FROM Administrador 
                WHERE Administrador.nombre like '%". $str ."%' OR Administrador.apellido like '%" . $str . "%' OR Administrador.email like '%" . $str . "%'
                LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
    }

    public function filtroCantidad($str){
        return "SELECT count(*) 
                FROM Administrador
                WHERE Administrador.nombre like '%". $str ."%' OR Administrador.apellido like '%" . $str . "%' OR Administrador.email like '%" . $str . "%'";
    }

}

?>