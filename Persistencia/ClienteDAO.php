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

    public function registrar($codigoActivacion){
        return "INSERT INTO Cliente (nombre, apellido, email, clave, estado, activation)
                VALUES ('" . $this -> nombre . "', '" . $this -> apellido . "', '" . $this -> correo . "', '" . md5($this -> clave)  . "', '-1', '" . md5($codigoActivacion) . "')";
    }

    public function existeCorreo(){
        return "SELECT idCliente
                FROM Cliente
                WHERE email = '" . $this -> correo . "'";
    }

    public function verificarActivacion($codigoActivacion){
        return "SELECT idCliente 
                FROM cliente 
                WHERE email = '" . $this -> correo . "' AND activation = '" . md5($codigoActivacion) . "'";
    }

    public function activacion(){
        return "UPDATE Cliente 
                SET estado = 1 
                WHERE email = '" . $this -> correo . "'";
    }

    public function getInfoBasic(){

        return "SELECT idCliente, nombre, apellido, email, clave, foto, estado 
        FROM Cliente 
        WHERE idCliente = ". $this -> idCliente;

    }

    public function buscarPaginado($pag, $cant){
        return "SELECT idCliente, nombre, apellido, email, clave, foto, estado, activation 
                FROM Cliente
                LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
    }

    public function buscarCantidad(){
        return "SELECT count(*) 
                FROM Cliente";
    }

    public function filtroPaginado($str, $pag, $cant){
        return "SELECT idCliente, nombre, apellido, email, estado 
                FROM Cliente 
                WHERE Cliente.nombre like '%". $str ."%' OR Cliente.apellido like '%" . $str . "%' OR Cliente.email like '%" . $str . "%'
                LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
    }

    public function filtroCantidad($str){
        return "SELECT count(*) 
                FROM Cliente
                WHERE Cliente.nombre like '%". $str ."%' OR Cliente.apellido like '%" . $str . "%' OR Cliente.email like '%" . $str . "%'";
    }

    public function updateEstado(){
        return "UPDATE Cliente
                SET
                    estado = ". $this -> estado . "
                WHERE idCliente = " . $this -> idCliente;
    }
}
