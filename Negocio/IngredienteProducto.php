<?php 

    require_once "Persistencia/Conexion.php";
    require_once "Persistencia/IngredienteProductoDAO.php";

class IngredienteProducto{
    private $producto;
    private $ingrediente;
    private $cantidad;

    private $IngredienteProductoDAO;
    private $Conexion;

    public function IngredienteProducto ($producto = "", $ingrediente ="", $cantidad = ""){
        $this -> producto = $producto;
        $this -> ingrediente = $ingrediente;
        $this -> cantidad = $cantidad;

        $this -> IngredienteProductoDAO = new IngredienteProductoDAO($this -> producto, $this -> ingrediente, $this -> cantidad);
        $this -> Conexion = new Conexion();
    }

    /*GETS*/

    public function getProducto(){
        return $this -> producto;
    }

    public function getIngrediente(){
        return $this -> ingrediente;
    }

    public function getCantidad(){
        return $this -> cantidad;
    }

    /*SETS*/

    public function setProducto($producto){
        $this -> producto = $producto;
    }

    public function setingrediente($ingrediente){
        $this -> ingrediente = $ingrediente;
    }

    public function setCantidad($cantidad){
        $this -> cantidad = $cantidad;
    }

    /*Methods*/

    /*
     * Busca todos los ingredientes asociados a un producto
     */

    public function buscarIngredientes(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> IngredienteProductoDAO -> buscarIngredientes());
        $resList = array();
        while($res = $this -> Conexion -> extraer()){
            array_push($resList, $res);
        }
        $this -> Conexion -> cerrar();
        return $resList;
    }

    /*
     * Busca 
     */

    public function buscarIngrediente(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> IngredienteProductoDAO -> buscarIngrediente());
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /*
     * Elimina un ingrediente que esta asociado a un producto
     */
    public function eliminar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> IngredienteProductoDAO -> eliminar());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /*
     * Agrega un nuevo ingrediente a un producto
     */
    public function agregar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> IngredienteProductoDAO -> agregar());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /*
     * Actualiza el producto en la base de datos
     */
    public function actualizar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> IngredienteProductoDAO -> actualizar() );
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

}

?>