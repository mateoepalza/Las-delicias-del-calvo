<?php

class FacturaDAO{
    private $idFactura;
    private $fecha;
    private $valor;
    private $cliente;

    public function FacturaDAO($idFactura = "", $fecha = "", $valor = "", $cliente = ""){
        $this -> idFactura = $idFactura;
        $this -> fecha = $fecha;
        $this -> valor = $valor;
        $this -> cliente = $cliente;
    }

    public function getInfoBasic(){
        return "SELECT idFactura, fecha, valor, FK_idCliente 
                FROM Factura
                WHERE idFactura = ".$this -> idFactura;
    }

    public function crearFactura(){
        return "INSERT INTO Factura (fecha, valor, FK_idCliente)
                VALUES ('" . $this -> fecha . "','" . $this -> valor . "','" . $this -> cliente . "')";
    }

    public function buscarPaginado($pag, $cant){
        return "SELECT idFactura, fecha, valor, Cliente.nombre 
                FROM Factura 
                INNER JOIN Cliente 
                ON FK_idCliente = idCliente 
                LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
    }

    public function buscarCantidad(){
        return "SELECT count(*) 
                FROM Factura";
    }

    public function filtroPaginado($str, $pag, $cant){
        return "SELECT idFactura, fecha, valor,  Cliente.nombre 
                FROM Factura
                INNER JOIN Cliente 
                ON FK_idCliente = idCliente 
                WHERE idFactura like '%". $str ."%' OR valor like '%". $str ."%' OR Cliente.nombre like '%". $str ."%' OR fecha like '%". $str ."%'
                LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
    }

    public function filtroCantidad($str){
        return "SELECT count(*) 
                FROM Factura
                INNER JOIN Cliente 
                ON FK_idCliente = idCliente 
                WHERE idFactura like '%". $str ."%' OR valor like '%". $str ."%' OR Cliente.nombre like '%". $str ."%' OR fecha like '%". $str ."%'";
    }

    public function buscarPaginadoCliente($pag, $cant){
        return "SELECT idFactura, fecha, valor 
                FROM Factura 
                WHERE FK_idCliente = '" . $this -> cliente . "'
                LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
    }

    public function buscarCantidadCliente(){
        return "SELECT count(*) 
                FROM Factura
                WHERE FK_idCliente = " . $this -> cliente;
    }

    public function filtroPaginadoCliente($str, $pag, $cant){
        return "SELECT idFactura, fecha, valor,  Cliente.nombre 
                FROM Factura
                INNER JOIN Cliente 
                ON FK_idCliente = idCliente 
                WHERE (idFactura like '%". $str ."%' OR valor like '%". $str ."%' OR Cliente.nombre like '%". $str ."%' OR fecha like '%". $str ."%') AND FK_idCliente = '" . $this -> cliente . "'
                LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
    }

    public function filtroCantidadCliente($str){
        return "SELECT count(*) 
                FROM Factura
                INNER JOIN Cliente 
                ON FK_idCliente = idCliente 
                WHERE (idFactura like '%". $str ."%' OR valor like '%". $str ."%' OR Cliente.nombre like '%". $str ."%' OR fecha like '%". $str ."%') AND FK_idCliente = '" . $this -> cliente . "' ";
    }

}