<?php 

    require_once "Persistencia/Conexion.php";
    require_once "Persistencia/CarritoDAO.php";

class Carrito {

    private $producto;
    private $cantidad;
    private $Conexion;
    private $CarritoDAO;

    public function Carrito($producto = "", $cantidad = ""){

        $this -> producto = $producto;
        $this -> cantidad = $cantidad;

        $this -> Conexion = new Conexion();
        $this -> CarritoDAO = new CarritoDAO();
    }

    /*GETS*/

    public function getProducto(){
        return $this -> producto;
    }

    public function getCantidad(){
        return $this -> cantidad;
    }

    /*SETS*/

    public function setProducto($producto){
        $this -> producto = $producto;
    }

    public function setCantidad($cantidad){
        $this -> cantidad = $cantidad;
    }

    /* Methods */

    /*
     * Mira si el producto ya existe en el carrito
     */

    public function checkCarrito(){

        $carrito = $_SESSION['carrito'];
        $bool = false;

        for($i = 0; $i < count($carrito); $i++){
            if($carrito[$i][0] == $this -> producto){
                $bool = true;
            }
        }

        return $bool;
    }

    /*
     * Actualizar cantidad de producto
     */

    public function actualizarCantidad(){

        $carrito = $_SESSION['carrito'];
        $flag = 0;

        for($i = 0; $i < count($carrito); $i++){
            if($carrito[$i][0] == $this -> producto){
                $_SESSION['carrito'][$i][1] = $this -> cantidad;
                $flag = 1;
            }
        }

        return $flag;

    }

    /*
     * agrega un nuevo producto al carrito 
     */
    public function agregarProducto(){
        array_push($_SESSION['carrito'], array($this -> producto, $this -> cantidad));
    }

    /*
    */
    public function totalItemsCarrito(){
        return count($_SESSION['carrito']);
    }

    /*
     * Busca todos los productos por medio de su id y devuelve los objetos en forma de lista
     */
    public function searchCarritoItems(){

        $carrito = $_SESSION['carrito'];
        $resList = array();

        for($i = 0; $i < count($carrito); $i++){
            $p = new Producto($carrito[$i][0]);
            $p -> searchItemById();
            array_push($resList, array($p, $carrito[$i][1]));
        }

        return $resList;
    }

    /*
     * Obtiene el precio total de los productos
     */

    public function getTotalPriceList($lista){
        $suma = 0;
        foreach($lista as $prod){
            $suma += ($prod[0] -> getPrecio() * $prod[1]);
        }

        return $suma;
    }

    /*
     * Eliminar producto del carrito
     */

    public function eliminarCarrito(){

        $carrito = $_SESSION['carrito'];
        $flag = false;

        for($i = 0; $i < count($carrito); $i++){
            if($carrito[$i][0] ==  $this -> producto){
                //unset($_SESSION['carrito'][$i]);
                array_splice($_SESSION['carrito'], $i,1);
                //var_dump($_SESSION['carrito']);
                $flag = true;
            }
        }

        return $flag;

    }

    /*
     * lista -> ingredientes en array FK_idProducto, FK_idIngrediente , IngredienteProducto.cantidad , Ingrediente.cantidad 
     *  $ingre -> FK_idProducto, FK_idIngrediente , cantidad 
     */

    public function ingredientesUsados(){
        $carrito = $_SESSION['carrito'];

        $resList = array();

        foreach($carrito as $item){
            $InPro = new IngredienteProducto($item[0]);
            $listaIngredienteCarrito = $InPro -> buscarIngredienteOb();
            array_push($resList, array($listaIngredienteCarrito, $item[1]));
        }

        return $resList;

    }

}

?>