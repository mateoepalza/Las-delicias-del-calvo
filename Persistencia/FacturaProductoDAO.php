<?php 

class FacturaProductoDAO{
    private $factura;
    private $producto;
    private $cantidad;
    private $precio;

    public function FacturaProductoDAO($factura = "", $producto = "", $cantidad = "", $precio =""){
        $this -> factura = $factura;
        $this -> producto = $producto;
        $this -> cantidad = $cantidad;
        $this -> precio = $precio;
    }

    /* Methods */

    public function agregar(){
        return "INSERT INTO FacturaProducto (FK_idFactura, FK_idProducto, cantidad, precio) 
                VALUES ('" . $this -> factura . "','" . $this -> producto . "','" . $this -> cantidad . "','" . $this -> precio . "')";
    }

    public function getProductosFactura(){
        return "SELECT FK_idFactura, Producto.nombre, cantidad, FacturaProducto.precio
                FROM FacturaProducto
                INNER JOIN Producto
                ON FK_idProducto = idProducto
                WHERE FK_idFactura = " . $this -> factura;
    }

    public function cantProductosFacturas(){
        return "SELECT count(*)
                FROM FacturaProducto
                WHERE FK_idFactura = " . $this -> factura;
    }

}
?>