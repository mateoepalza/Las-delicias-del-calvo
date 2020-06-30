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

    public function getInfoBasic(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> FacturaDAO -> getInfoBasic());
        $res = $this -> Conexion -> extraer();
        $this -> idFactura = $res[0];
        $this -> fecha = $res[1];
        $this -> valor = $res[2];
        $this -> cliente = $res[3];
        $this -> Conexion -> cerrar();
    }

    public function pago(){

        $bool = false;
        $carrito = dSerializeC();
        $resCheck = $carrito -> checkOut();
        if($resCheck){
            
            $res = $this -> crearFactura();
            if($res == 1){
                $bool = $this -> agregarProductosFactura($carrito -> getListProducto());
                if(!$bool){
                    echo "Entraaa";
                    $resCheck = $carrito -> transaction();
                    if(!$resCheck){
                        $carrito -> vaciarCarrito();
                        $bool = true;
                    }
                }   
            }
        }
        serializeC($carrito);

        return $bool;

    }

    public function agregarProductosFactura($listProductos){
        $bool = false;
        foreach($listProductos as $prod){
            $newFP = new FacturaProducto($this -> idFactura, $prod[0]-> getIdProducto(), $prod[1], $prod[0] -> getPrecio());
            $res = $newFP -> agregar();
            if($res != 1){
                $bool = true;
            }
        }

        return $bool;
        
    }

    public function crearFactura(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> FacturaDAO -> crearFactura());
        $this -> idFactura = $this -> Conexion -> getLastID();
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /*
     * Función que busca por paginación y devuelve n objetos de tipo Producto en un array
     */
    public function buscarPaginado($pag, $cant){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> FacturaDAO -> buscarPaginado($pag, $cant));
        $resList = Array();
        while($res = $this -> Conexion -> extraer()){
            array_push($resList, new Factura($res[0], $res[1], $res[2], $res[3]));
        }
        $this -> Conexion -> cerrar();

        return $resList;
    }

    /*
     * Busca la cantidad de registros sin ningun filtro
     */
    public function buscarCantidad(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> FacturaDAO -> buscarCantidad());
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();
        return $res[0];
    }

    /*
     * Función que busca por paginación, filtro de palabra y devuelve la información en un array
     */
    public function filtroPaginado($str, $pag, $cant){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> FacturaDAO -> filtroPaginado($str, $pag, $cant));
        $resList = Array();
        while($res = $this -> Conexion -> extraer()){
            array_push($resList, $res);
        }
        $this -> Conexion -> cerrar();

        return $resList;
    }

    /*
     * Busca la cantidad de registros con filtro de palabra
     */
    public function filtroCantidad($str){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> FacturaDAO -> filtroCantidad($str));
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();

        return $res[0];
    }

    /**
     * Busca las facturas de un cliente en especifico
     */
    public function buscarPaginadoCliente($pag, $cant){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> FacturaDAO -> buscarPaginadoCliente($pag, $cant));
        $resList = array();

        while($res = $this -> Conexion -> extraer()){
            array_push($resList, new Factura($res[0], $res[1], $res[2]));
        }

        $this -> Conexion -> cerrar();

        return $resList;
    }

    /*
     * Busca la cantidad de registros sin ningun filtro de un cliente en especifico
     */
    public function buscarCantidadCliente(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> FacturaDAO -> buscarCantidadCliente());
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();
        return $res[0];
    }

    /*
     * Función que busca por paginación, filtro de palabra, por cliente y devuelve la información en un array
     */
    public function filtroPaginadoCliente($str, $pag, $cant){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> FacturaDAO -> filtroPaginadoCliente($str, $pag, $cant));
        $resList = Array();
        while($res = $this -> Conexion -> extraer()){
            array_push($resList, $res);
        }
        $this -> Conexion -> cerrar();

        return $resList;
    }

    /*
     * Busca la cantidad de registros con filtro de palabra y cliente
     */
    public function filtroCantidadCliente($str){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> FacturaDAO -> filtroCantidadCliente($str));
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();

        return $res[0];
    }

}

?>