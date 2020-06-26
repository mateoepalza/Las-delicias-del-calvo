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

    public function crearFactura(){
        return "INSERT INTO Factura (fecha, valor, FK_idCliente)
                VALUES ('" . $this -> fecha . "','" . $this -> valor . "','" . $this -> cliente . "')";
    }
}