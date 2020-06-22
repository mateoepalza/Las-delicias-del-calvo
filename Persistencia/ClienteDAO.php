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
        FROM cliente ";

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
                WHERE Cliente.nombre like '%" . $str . "%'";
    }

    public function updateEstado(){
        return "UPDATE Cliente
                SET
                    estado = ". $this -> estado . "
                WHERE idCliente = " . $this -> idCliente;
    }
}
