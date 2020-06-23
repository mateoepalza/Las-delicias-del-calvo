<?php 

class ClienteDAO{
    private $idCliente;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $foto;
    private $estado;
    private $activacion;

    public function ClienteDAO($idCliente = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $foto = "", $estado = "", $activacion = ""){
        $this -> idCliente = $idCliente;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> foto = $foto;
        $this -> estado = $estado;
        $this -> activacion = $activacion;
    }

    public function autenticar(){
        return "SELECT idCliente, nombre, apellido, foto, estado, activation 
                FROM cliente 
                WHERE email = '" . $this -> correo . "' AND clave ='" . md5($this -> clave) . "'";
    }

    public function getInfoBasic(){

        return "SELECT idCliente, nombre, apellido, email, clave, foto, estado 
        FROM cliente 
        WHERE idCliente = ". $this -> idCliente;

    }
}
