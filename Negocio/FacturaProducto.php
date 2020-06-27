<?php 

    require_once "Persistencia/Conexion.php";
    require_once "Persistencia/FacturaProductoDAO.php";

class FacturaProducto{
    private $factura;
    private $producto;
    private $cantidad;
    private $precio;

    private $Conexion;
    private $FacturaProductoDAO;

    public function FacturaProducto($factura = "", $producto = "", $cantidad = "", $precio =""){
        $this -> factura = $factura;
        $this -> producto = $producto;
        $this -> cantidad = $cantidad;
        $this -> precio = $precio;

        $this -> Conexion = new Conexion();
        $this -> FacturaProductoDAO = new FacturaProductoDAO( $this -> factura, $this -> producto, $this -> cantidad, $this -> precio);

    }

    /*GETS*/

    public function getFactura(){
        return $this -> factura;
    }
    public function getProducto(){
        return $this -> producto;
    }
    public function getCantidad(){
        return $this -> cantidad;
    }
    public function getPrecio(){
        return $this -> precio;
    }

    /*SETS*/

    public function setFactura($factura){
        $this -> factura = $factura;
    }
    public function setProducto($producto){
        $this -> producto = $producto;
    }
    public function setCantidad($cantidad){
        $this -> cantidad = $cantidad;
    }
    public function setPrecio($precio){
        $this -> precio = $precio;
    }
    public function setConexion($Conexion){
        $this -> Conexion = $Conexion;
    }

    /* Methods */

    public function agregar(){
        $this -> Conexion -> abrir();
        echo "<br>".$this -> FacturaProductoDAO -> agregar()."<br>";
        $this -> Conexion -> ejecutar($this -> FacturaProductoDAO -> agregar());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    public function getProductosFactura(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> FacturaProductoDAO -> getProductosFactura() );
        $resList = array();
        while($res = $this -> Conexion -> extraer()){
            array_push($resList, new FacturaProducto($res[0], $res[1], $res[2], $res[3]));
        }
        $this -> Conexion -> cerrar();
        return $resList;
    }

}

?>