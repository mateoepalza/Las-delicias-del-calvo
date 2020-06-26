<?php

    require_once "Persistencia/Conexion.php";
    require_once "Persistencia/FacturaDAO.php";

class Factura{
    private $idFactura;
    private $fecha;
    private $valor;
    private $cliente;

    private $FacturaDAO;
    private $Conexion;

    public function Factura($idFactura = "", $fecha = "", $valor = "", $cliente = ""){
        $this -> idFactura = $idFactura;
        $this -> fecha = $fecha;
        $this -> valor = $valor;
        $this -> cliente = $cliente;

        $this -> FacturaDAO = new FacturaDAO($this -> idFactura, $this -> fecha, $this -> valor, $this -> cliente);
        $this -> Conexion = new Conexion();

    }

    /*GETS*/

    public function getIdFactura(){
        return $this -> idFactura;
    }
    public function getFecha(){
        return $this -> fecha;
    }
    public function getValor(){
        return $this -> valor;
    }
    public function getCliente(){
        return $this -> cliente;
    }

    /* SETS */

    public function setIdFactura($idFactura){
        $this -> idFactura = $idFactura;
    }
    public function setFecha($fecha){
        $this -> fecha = $fecha;
    }
    public function setValor($valor){
        $this -> valor = $valor;
    }
    public function setCliente($cliente){
        $this -> cliente = $cliente;
    }
    public function setConexion($Conexion){
        $this -> Conexion = $Conexion;
    }

    /*Methods*/

    public function pago(){

        $producto = new Producto();
        $resCheck = $producto -> checkOut();
        if($resCheck){
            $resCheck = $producto -> transaction();
            if($resCheck){
                $carrito  = new Carrito();
                $carrito -> vaciarCarro();
            }
        }

        return $resCheck;

    }

    public function crearFactura(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> FacturaDAO -> crearFactura());
        $this -> idFactura = $this -> Conexion -> getLastID();
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

}

?>