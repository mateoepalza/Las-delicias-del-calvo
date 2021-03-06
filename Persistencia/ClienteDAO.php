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
        return "INSERT INTO Cliente (nombre, apellido, email, clave, foto, estado, activation)
                VALUES ('" . $this -> nombre . "', '" . $this -> apellido . "', '" . $this -> correo . "', '" . md5($this -> clave)  . "', '" . $this -> foto . "' ,'-1', '" . md5($codigoActivacion) . "')";
    }

    public function existeCorreo(){
        return "SELECT idCliente
                FROM Cliente
                WHERE email = '" . $this -> correo . "'";
    }

    public function existeNuevoCorreo($correo){
        return "SELECT idCliente
                FROM Cliente
                WHERE email = '" . $correo . "'";
    }

    public function checkClave(){
        return "SELECT idCliente
                FROM Cliente
                WHERE idCliente = '" . $this -> idCliente . "' AND clave = '" . md5($this -> clave) . "'";
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

    public function insertar(){
        return "INSERT INTO Cliente (nombre, apellido, email, clave, foto, estado) 
                VALUES ('" . $this -> nombre ."', '" . $this -> apellido  ."', '" . $this -> correo  ."', '" . md5($this -> clave)  ."', '" . $this -> foto . "' ,'" . $this -> estado  ."')";
    }

    public function actualizar(){
        return "UPDATE Cliente
                SET
                    nombre = '" . $this -> nombre . "',
                    apellido = '" . $this -> apellido . "',
                    email = '" . $this -> correo . "',
                    estado = '" . $this -> estado . "'
                WHERE idCliente = ". $this -> idCliente;
    }

    public function actualizarBasic(){
        return "UPDATE Cliente
                SET
                    nombre = '" . $this -> nombre . "',
                    apellido = '" . $this -> apellido . "',
                    email = '" . $this -> correo . "',
                    foto = '" . $this -> foto . "'
                WHERE idCliente = ". $this -> idCliente;
    }

    public function actualizarClave($nuevaClave){
        return "UPDATE Cliente
                SET
                    clave = '" . md5($nuevaClave) . "'
                WHERE idCliente = " . $this -> idCliente;
    }

    public function actualizarCClave(){
        return "UPDATE Cliente
                SET
                    nombre = '" . $this -> nombre . "',
                    apellido = '" . $this -> apellido . "',
                    email = '" . $this -> correo . "',
                    estado = '" . $this -> estado . "',
                    clave = '" . md5($this -> clave) . "'
                WHERE idCliente = ". $this -> idCliente;
    }
}
