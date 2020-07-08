<?php 

    require_once "Persistencia/Conexion.php";
    require_once "Persistencia/CarritoDAO.php";
    require_once "Helpers/serialize.php";

class Carrito {

    private $listProducto;

    private $Conexion;
    private $CarritoDAO;

    public function Carrito(){

        $this -> listProducto = array();
        $this -> Conexion = new Conexion();
        $this -> CarritoDAO = new CarritoDAO();
    }

    /*GETS*/

    public function getListProducto(){
        return $this -> listProducto;
    }

    /*SETS*/

    public function setListProducto($listProducto){
        $this -> listProducto = $listProducto;
    }

    /* Methods */

    public function vaciarCarrito(){
        $this -> listProducto = array();
    }

    public function buscarTupla($idProducto){

        $obj = array();

        foreach($this -> listProducto as $pair){
            if($pair[0] -> getIdProducto() == $idProducto){
                $obj = $pair;
            }
        }

        return $obj;

    }

    public function buscarCantidadProductoCarrito($idProducto){

        $arr = $this -> buscarTupla($idProducto);

        if(count($arr) > 0){
            return $arr[1];
        }else{
            return 1;
        }

    }

    public function checkCarrito($idProducto){

        $arr = $this -> buscarTupla($idProducto);

        if(count($arr) > 0){
            return true;
        }else{
            return false;
        }

    }

    public function actualizarCantidadProducto($idProducto, $cantidad){

        
        $bool = false;

        for($i = 0; $i < count($this -> listProducto); $i++){
            if($this -> listProducto[$i][0] -> getIdProducto() == $idProducto){
                $this -> listProducto[$i][1] = $cantidad;
                $bool = true;
            }
        }

        return $bool;
    }

    public function agregarProductoCarrito($idProducto, $cantProd){
        $producto = new Producto($idProducto);
        array_push($this -> listProducto, array($producto, $cantProd));
    }

    public function cantidadItems(){
        return count($this -> listProducto);
    }
    /**
     * actualiza los objetos de tipo producto que se encuentran en el carrito
     */
    public function todaInfoProductos(){

        for($i = 0; $i < count($this -> listProducto); $i++){
            $this -> listProducto[$i][0] -> getInfoBasic();
        }
    }

    public function searchCarritoItems(){
        $this -> todaInfoProductos();
        return $this -> listProducto;
    }

    public function getTotalPriceList(){

        $suma = 0;

        for($i = 0; $i < count($this -> listProducto); $i++){
            $suma += ($this -> listProducto[$i][0] -> getPrecio() * $this -> listProducto[$i][1] );
        }

        return $suma;
    }

//
    public function eliminarCarrito($idProducto){

        
        $bool = false;

        for($i = 0; $i < count($this -> listProducto); $i++){
            if($this -> listProducto[$i][0] -> getIdProducto() == $idProducto){
                array_splice($this -> listProducto, $i,1);
                $bool = true;
            }
        }

        return $bool;

    }
    /**
     * Devuelve todos los ingredientes de un producto en especifico
     */
    public function getProductoIngredientes($idProducto){
        $ingredientes = new IngredienteProducto($idProducto);
        return $ingredientes -> buscarIngredienteOb();

    }
    /**
     * Genera una matriz en donde en un lado tiene el ingrediente y en el otro la cantidad solicitada
     */
    public function addColumnValue($arr, $value){

        $arrKey = array();

        for($i = 0; $i < count($arr); $i++){
            array_push($arrKey,array($arr[$i], $arr[$i] -> getCantidad() * $value));
        }

        return $arrKey;
    }

    /**
     * Genero un solo array sin ingredientes repetidos sumando los que estaban repetidos y borrandolos
     */
    public function adicionarRepetidos($list){

        /*echo('<pre>');
        var_dump($list);
        echo('</pre>');*/

        for($i = 0; $i < count($list); $i++){
            for($j = $i+1; $j < count($list); $j++){
                if($list[$i][0] -> getIngrediente() == $list[$j][0] -> getIngrediente()){
                    $list[$i][1] += $list[$j][1];
                    array_splice($list, $j,1);
                }
            }
        }
        return $list;
    }

    /**
     * Se encarga de obtener todos los ingredientes sumando las cantidades de los inggredientes de los productos en el carrito
     */
    public function getListIngredientesCarritoItems($listCarrito){

        $listIngredientesProducto = array();

        foreach($listCarrito as $item){
            $res = $this -> getProductoIngredientes($item[0] -> getIdProducto());
            $res = $this -> addColumnValue($res, $item[1]);
            $listIngredientesProducto = array_merge($listIngredientesProducto, $res);
        }

        return $this -> adicionarRepetidos($listIngredientesProducto);

    }

    /**
     * Se encarga de multiplicar la cantidad del nuevo producto por la cantidad seleccionada
     */
    public function getProductoIngredientesCantidad($arr, $cant){
        for($i = 0; $i < count($arr); $i++){
            $arr[$i] -> setCantidad($arr[$i] -> getCantidad()* $cant) ; 
        }
        return $arr;
    }

    /**
     * Se encarga de sumar la cantidad de productos que se necesitan en el inventario para poder adicionar el producto
     */

    public function sumarNuevoConCarrito($arrProd, $arrCar){

        for($i = 0; $i < count($arrProd); $i++){
            for($j = 0; $j < count($arrCar); $j++){
                if($arrProd[$i] -> getIngrediente() == $arrCar[$j][0] -> getIngrediente() ){
                    $arrProd[$i] -> setCantidad($arrProd[$i] -> getCantidad() + $arrCar[$j][1]);
                }
            }
        }

        return $arrProd;

    }

    /**
     * Me devuelve los ingredientes y sus cantidade para poder compararlos
     */

    public function ingredientesAComparar($list){

        $arrIngredientes = array();

        foreach($list as $item){
            $ingre = new Ingrediente($item -> getIngrediente());
            $ingre -> getInfoBasic();
            array_push($arrIngredientes, $ingre);
        }
        return $arrIngredientes;
    }

    public function ingredientesACompararArray($list){
        $arrIngredientes = array();

        foreach($list as $item){
            $ingre = new Ingrediente($item[0] -> getIngrediente());
            $ingre -> getInfoBasic();
            array_push($arrIngredientes, $ingre);
        }
        return $arrIngredientes;
    }

    public function compararCantidades($ingre, $carr){
        $bool = true;

        foreach($carr as $item){
            foreach($ingre as $elem){
                if(($item -> getIngrediente() == $elem -> getIdIngrediente()) && ($elem -> getCantidad() < $item -> getCantidad())){
                    $bool = false;
                }
            }
        }
        return $bool;
    }

    public function compararCantidadesAjax($ingre, $carr){
        $bool = true;

        foreach($carr as $item){
            foreach($ingre as $elem){
                if(($item[0] -> getIngrediente() == $elem -> getIdIngrediente()) && ($elem -> getCantidad() < $item[1])){
                    $bool = false;
                }
            }
        }
        return $bool;
    }

    public function actualizarCopyListaCarrito($copyLista, $idProducto, $cant){
        for($i = 0; $i < count($copyLista); $i++){
            if($copyLista[$i][0] -> getIdProducto() == $idProducto){
                $copyLista[$i][1] = $cant;
            }
        }

        return $copyLista;
    }

    public function remainCantidadIngredientes($ingredientes, $listIngredientesCarrito){
        $bool = false;
        for($i = 0; $i < count($ingredientes); $i++){
            for($j = 0; $j < count($listIngredientesCarrito); $j++){
                if($ingredientes[$i] -> getIdIngrediente() == $listIngredientesCarrito[$j][0] -> getIngrediente()){
                    $ingredientes[$i] -> setCantidad( $ingredientes[$i] -> getCantidad() - $listIngredientesCarrito[$j][1]);
                    $res = $ingredientes[$i] -> actualizarCantidad();
                    if($res != 1){
                        $bool = true;
                    }
                }
            }
        }
        return $bool;
    }

    public function getStock($idProducto, $cant){


        /**
         * Buscar si el producto ya está en el carrito
         */

        if(!$this -> checkCarrito($idProducto)){

            /**
             * Lista de ingredienteProducto de un producto [FK_idProducto, FK_idIngrediente, cantidad]
             */
            $listIngredientesProducto = $this -> getProductoIngredientes($idProducto);
            $listIngredientesProducto = $this -> getProductoIngredientesCantidad($listIngredientesProducto, $cant);
            
            /*foreach($listIngredientesProducto as $arr){
                echo $arr -> getIngrediente() . " - " . $arr -> getCantidad() . "<br>";
            }*/
            
            /**
             * Lista de ingredientes de los productos en la lista 
             */

            $listIngredientesCarrito = $this -> getListIngredientesCarritoItems($this -> listProducto);
            /*echo "-------------------------------<br>";
            foreach($listIngredientesCarrito as $arr){
                echo $arr[0] -> getIngrediente() . " - " . $arr[0] -> getCantidad() . " - " . $arr[1] . "<br>";
            }*/

            /**
             * Sumar el producto a ingresar 
             */

            $finalList = $this -> sumarNuevoConCarrito($listIngredientesProducto, $listIngredientesCarrito);
            /*echo "-------------------------------<br>";
            foreach($finalList as $arr){
                echo $arr -> getIngrediente() . " - " . $arr -> getCantidad() . "<br>";
            }*/

            /**
             * Obtener ingredientes a comparar
             */
            $ingredientes = $this -> ingredientesAComparar($finalList);

            /*echo "-------------------------------<br>";
            foreach($ingredientes as $arr){
                echo $arr -> getIdIngrediente() . " - " . $arr -> getCantidad() . "<br>";
            }*/

            /**
             * Comparar la cantidad de ingredientes necesarios con los que se encuentran en la base de datos
             */

            return $this -> compararCantidades($ingredientes, $finalList);
            /*echo('<pre>');
            var_dump($listIngredientesCarrito);
            echo('</pre>');*/
        

        }else{
            return true;
        }

        
    }

    public function getStockAjax($idProducto, $cant){

        if($this -> checkCarrito($idProducto)){

            $copyLista = $this -> listProducto;

            /*foreach($copyLista as $item){
                echo "\n" . $item[0] -> getIdProducto() . " - " . $item[1];
            }
            echo "\n -------------------------------------------------- \n";*/
            $copyLista = $this -> actualizarCopyListaCarrito($copyLista, $idProducto, $cant);

            /*foreach($copyLista as $item){
                echo "\n" . $item[0] -> getIdProducto() . " - " . $item[1];
            }*/
            
            $listIngredientesCarrito = $this -> getListIngredientesCarritoItems($copyLista);

            /*echo "\n-------------------------------\n";
                foreach($listIngredientesCarrito as $arr){
                    echo $arr[0] -> getIngrediente() . " - " . $arr[1]  . "\n";
                }*/

            $ingredientes = $this -> ingredientesACompararArray($listIngredientesCarrito);

            /*echo "\n-------------------------------\n";
                foreach($ingredientes as $arr){
                    echo $arr -> getIdIngrediente() . " - " . $arr -> getCantidad() . "\n";
                }*/

            return  $this -> compararCantidadesAjax($ingredientes, $listIngredientesCarrito);

        }else{
            return $this -> getStock($idProducto, $cant);
        }

    }

    public function checkout(){
        $listIngredientesCarrito = $this -> getListIngredientesCarritoItems($this -> listProducto);

        /*echo "\n-------------------------------\n";
        foreach($listIngredientesCarrito as $arr){
            echo $arr[0] -> getIngrediente() . " - " . $arr[1]  . "\n";
            }*/

        $ingredientes = $this -> ingredientesACompararArray($listIngredientesCarrito);

        /*echo "\n-------------------------------\n";
        foreach($ingredientes as $arr){
                echo $arr -> getIdIngrediente() . " - " . $arr -> getCantidad() . "\n";
        }*/

        return  $this -> compararCantidadesAjax($ingredientes, $listIngredientesCarrito);
    }

    public function transaction(){
        $listIngredientesCarrito = $this -> getListIngredientesCarritoItems($this -> listProducto);

        /*echo "\n-------------------------------\n";
        foreach($listIngredientesCarrito as $arr){
            echo $arr[0] -> getIngrediente() . " - " . $arr[1]  . "\n";
        }*/

        $ingredientes = $this -> ingredientesACompararArray($listIngredientesCarrito);

        /*echo "\n-------------------------------\n";
        foreach($ingredientes as $arr){
                echo $arr -> getIdIngrediente() . " - " . $arr -> getCantidad() . "\n";
        }*/

        return $this -> remainCantidadIngredientes($ingredientes, $listIngredientesCarrito);
    }

    //public function 

    /************************************************************************************************************************************* */
    /*
     *
     */

    /*public function vaciarCarro(){
        unset($_SESSION['carrito']);
        $_SESSION['carrito'] = array();

        var_dump($_SESSION['carrito']);
    }*/

    /*
     * Mira si el producto ya existe en el carrito
     */
    /*
    public function checkCarrito(){

        $carrito = $_SESSION['carrito'];
        $bool = false;

        for($i = 0; $i < count($carrito); $i++){
            if($carrito[$i][0] == $this -> producto){
                $bool = true;
            }
        }

        return $bool;
    }*/

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
    /*public function totalItemsCarrito(){
        return count($_SESSION['carrito']);
    }*/

    /*
     * Busca todos los productos por medio de su id y devuelve los objetos en forma de lista
     */
    /*public function searchCarritoItems(){

        $carrito = $_SESSION['carrito'];
        $resList = array();

        for($i = 0; $i < count($carrito); $i++){
            $p = new Producto($carrito[$i][0]);
            $p -> searchItemById();
            array_push($resList, array($p, $carrito[$i][1]));
        }

        return $resList;
    }*/

    /*
     * Obtiene el precio total de los productos
     */

    /*public function getTotalPriceList($lista){
        $suma = 0;
        foreach($lista as $prod){
            $suma += ($prod[0] -> getPrecio() * $prod[1]);
        }

        return $suma;
    }*/

    /*
     * Eliminar producto del carrito
     */

    /*public function eliminarCarrito(){

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

    }*/

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

    /*
     * Buscar producto en carrito
     */

    public function buscarProductoCarrito(){
        $carrito = $_SESSION['carrito'];

        $resList = array();

        foreach($carrito as $item){
            if($item[0] == $this -> producto){
                $resList[0] = $item[0];
                $resList[1] = $item[1];
            }
        }

        return $resList;
    }

    /*
     * Hace una copia de los items en el carrito con un valor actualizado para revisar si hay en stock o no
     */

    public function copyTryCarrito(){

        $carrito = $_SESSION['carrito'];

        $resList = array();

        foreach($carrito as $item){
            if($item[0] == $this -> producto){
                $item[1] = $this -> cantidad;
                array_push($resList, $item);
            }else{
                array_push($resList, $item);
            }
        }
        return $resList;
    }

    /*
     * lista -> ingredientes en array FK_idProducto, FK_idIngrediente , IngredienteProducto.cantidad , Ingrediente.cantidad 
     *  $ingre -> FK_idProducto, FK_idIngrediente , cantidad 
     */

    public function checkIngredientesUsados($carrito){

        $resList = array();

        foreach($carrito as $item){
            $InPro = new IngredienteProducto($item[0]);
            $listaIngredienteCarrito = $InPro -> buscarIngredienteOb();
            for($i = 0; $i < count($listaIngredienteCarrito); $i++){
                $listaIngredienteCarrito[$i] -> setCantidad($listaIngredienteCarrito[$i] -> getCantidad() *  $item[1]);
                array_push($resList, $listaIngredienteCarrito[$i]);
            }
        }

        return $resList;

    }

}

?>