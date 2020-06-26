<?php 

    require_once "Persistencia/Conexion.php";
    require_once "Persistencia/ProductoDAO.php";

class Producto{
    private $idProducto;
    private $nombre;
    private $foto;
    private $descripcion;
    private $precio;
    private $categoria;
    private $ProductoDAO;
    private $Conexion;

    public function Producto($idProducto = "", $nombre = "", $foto = "", $descripcion = "", $precio = "", $categoria = ""){
        $this -> idProducto = $idProducto;
        $this -> nombre = $nombre;
        $this -> foto = $foto;
        $this -> descripcion = $descripcion;
        $this -> precio = $precio;
        $this -> categoria = $categoria;
        $this -> ProductoDAO = new ProductoDAO($idProducto, $nombre, $foto, $descripcion, $precio, $categoria);
        $this -> Conexion = new Conexion();
    }

    /*SETS*/

    public function setIdProducto($idProducto){
        $this -> idProducto = $idProducto;
    }

    public function setNombre($nombre){
        $this -> nombre = $nombre;
    }

    public function setFoto($foto){
        $this -> foto = $foto;
    }

    public function setDescripcion($descripcion){
        $this -> descripcion = $descripcion;
    }

    public function setPrecio($precio){
        $this -> precio = $precio;
    }

    public function setCategoria($categoria){
        $this -> categoria = $categoria;
    }

    public function setConexion($Conexion){
        $this -> Conexion = $Conexion;
    }

    /*GETS*/

    public function getIdProducto(){
        return $this -> idProducto;
    }

    public function getNombre(){
        return $this -> nombre;
    }

    public function getFoto(){
        return $this -> foto;
    }

    public function getDescripcion(){
        return $this -> descripcion;
    }

    public function getPrecio(){
        return $this -> precio;
    }

    public function getCategoria(){
        return $this -> categoria;
    }

    /*Methods*/
    public function getInfo(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ProductoDAO -> getInfo());
        $res = $this -> Conexion -> extraer();
        $this -> nombre = $res[1];
        $this -> foto = $res[2];
        $this -> descripcion = $res[3];
        $this -> precio = $res[4];
        $this -> categoria = $res[6];
        $this -> Conexion -> cerrar();
    }

    public function getInfoBasic(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ProductoDAO -> getInfo());
        $res = $this -> Conexion -> extraer();
        $this -> nombre = $res[1];
        $this -> foto = $res[2];
        $this -> descripcion = $res[3];
        $this -> precio = $res[4];
        $this -> categoria = $res[5];
        $this -> Conexion -> cerrar();
    }

    /*
     * Función que inserta un nuevo producto
     */

    public function insertar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ProductoDAO -> insertar() );
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /*
     * Función que busca los productos destacados
     */
    public function getDestProducts(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ProductoDAO -> getDestProducts());
        $resList = array();
        while($res = $this -> Conexion -> extraer()){
            array_push($resList, new Producto($res[0], $res[1], $res[2], "",  $res[3]));
        }
        $this -> Conexion -> cerrar();

        return $resList;
    }

    /*
     * Productos por categoria
     */

    public function getProductsByCategory($category){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ProductoDAO -> getProductsByCategory($category));
        $resList = array();
        while($res = $this -> Conexion -> extraer()){
            array_push($resList, new Producto($res[0], $res[1], $res[2], "",  $res[3]));
        }
        $this -> Conexion -> cerrar();
        return $resList;
    }

    /*
     * Productos por categoria paginado
     */

    public function getProductsByCategoryPaginado($category, $pagina, $numReg){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ProductoDAO -> getProductsByCategoryPaginado($category, $pagina, $numReg));
        $resList = array();
        while($res = $this -> Conexion -> extraer()){
            array_push($resList, new Producto($res[0], $res[1], $res[2], "",  $res[3]));
        }
        $this -> Conexion -> cerrar();
        return $resList;
    }

    /*
     * Función que busca por paginación y devuelve n objetos de tipo Producto en un array
     */
    public function buscarPaginado($pag, $cant){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ProductoDAO -> buscarPaginado($pag, $cant));
        $resList = Array();
        while($res = $this -> Conexion -> extraer()){
            array_push($resList, new Producto($res[0], $res[1], $res[2], $res[3], $res[4], $res[5]));
        }
        $this -> Conexion -> cerrar();

        return $resList;
    }

    /*
     * Función que busca por paginación y devuelve la información en un array
     */
    public function buscarAPaginado($pag, $cant){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ProductoDAO -> buscarPaginado($pag, $cant));
        $resList = Array();
        while($res = $this -> Conexion -> extraer()){
            array_push($resList, $res);
        }
        $this -> Conexion -> cerrar();

        return $resList;
    }

    /*
     * ACAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
     */

    public function buscarAPaginadoByCategory($category, $pagina, $cantPag){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ProductoDAO -> buscarPaginadoByCategory($category, $pag, $cant));
        $resList = Array();
        while($res = $this -> Conexion -> extraer()){
            array_push($resList, $res);
        }
        $this -> Conexion -> cerrar();

        return $resList;
    }

    /*
     * Busca la cantidad de registros sin ningun filtro
     */
    public function buscarCantidad(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ProductoDAO -> buscarCantidad());
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();
        return $res[0];
    }

    /*
     * Buscar la cantidad de productos de una categoria especifica 
     */

    public function buscarCantidadByCategory($category){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ProductoDAO -> buscarCantidadByCategory($category));
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();
        return $res[0];
    }

    /*
     * Función que busca por paginación, filtro de palabra y devuelve la información en un array
     */
    public function filtroPaginado($str, $pag, $cant){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ProductoDAO -> filtroPaginado($str, $pag, $cant));
        $resList = Array();
        while($res = $this -> Conexion -> extraer()){
            array_push($resList, $res);
        }
        $this -> Conexion -> cerrar();

        return $resList;
    }

    /*
     * Función que busca por paginación, filtro de palabra en una categoria en especifico, devuelve la información en un array
     */

    public function filtroPaginadoByCategoria($category, $str, $pag, $cant){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ProductoDAO -> filtroPaginadoByCategoria($category, $str, $pag, $cant));
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
        $this -> Conexion -> ejecutar( $this -> ProductoDAO -> filtroCantidad($str));
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();

        return $res[0];
    }

    public function filtroCantidadByCategoria($category, $str){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ProductoDAO -> filtroCantidadByCategoria($category, $str));
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();

        return $res[0];
    }


    public function guardarImagen($tempName, $ruta){
        //$ruta = $ruta + rand(0,10000000);
        return  @move_uploaded_file($tempName, $ruta);
    }
    
    /*
     * Actualizar el producto
     */

    public function actualizarProducto(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ProductoDAO -> actualizarProducto());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /*
     * Busca todos los productos por medio de su id y devuelve los objetos en forma de lista
     */
    public function searchItemById(){

        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ProductoDAO -> searchItemById());
        $res = $this -> Conexion -> extraer();
        $this -> idProducto = $res[0];
        $this -> nombre = $res[1];
        $this -> foto = $res[2];
        $this -> descripcion = $res[3];
        $this -> precio = $res[4];
        $this -> Conexion -> cerrar();
    }

    /*
     * Search if a product is in stock 
     */

    public function getStock(){
        $carrito = new Carrito();
        $InProd = new IngredienteProducto($this -> idProducto);
        /*
         * [[FK_idProducto, FK_idIngrediente , IngredienteProducto.cantidad , Ingrediente.cantidad ]]
         */
        $ingredientesProd = $InProd -> buscarIngredientesProducto();

        $bool = true;

        foreach($ingredientesProd as $item){
            //echo $item[2]. " - ". $item[3] . "<br>";
            if($item[2] > $item[3]){
              //  echo $item[1] . "<br>";
                $bool = false;
            }
        }

        if($bool){

            /*
                 *  Me devuelve objetos de tipo ingrediente producto en la posicion 0 con [[FK_idProducto, FK_idIngrediente, cantidad], cantidad_session]
                 */
                $ingredientesUsadosCarrito = $carrito -> ingredientesUsados($ingredientesProd);
                $resList = array();
                foreach($ingredientesUsadosCarrito as $prodIngre){
                    foreach($ingredientesProd as $newProd){
                        foreach($prodIngre[0] as $itemCarrito){
                            //var_dump($itemCarrito ->  getIngrediente());
                            
                            if($itemCarrito -> getIngrediente() == $newProd[1]){
                                $boolean = true;
                                for($i = 0; $i < count($resList); $i++){
                                    if($resList[$i][0] == $newProd[1]){
                                        $resList[$i][1] += $itemCarrito -> getCantidad()* $prodIngre[1];
                                        $boolean = false;
                                    }
                                }
                                if($boolean){
                                    array_push($resList, array($itemCarrito -> getIngrediente(), $itemCarrito -> getCantidad()* $prodIngre[1]));
                                }
                                
                            }
                        }
                    }
                }
                /*
                $ingredientesUsadosCarrito = $carrito -> ingredientesUsados($ingredientesProd);
                $resList = array();
                foreach($ingredientesUsadosCarrito as $prodIngre){
                    foreach($ingredientesProd as $newProd){
                        foreach($prodIngre[0] as $itemCarrito){
                            //var_dump($itemCarrito ->  getIngrediente());
                            
                            if($itemCarrito -> getIngrediente() == $newProd[1]){
                                array_push($resList, array($itemCarrito -> getIngrediente(), $itemCarrito -> getCantidad()* $prodIngre[1]));
                            }
                        }
                    }
                }
                */
                foreach($ingredientesProd as $prod){
                    foreach($resList as $list)
                    if($prod[1] == $list[0]){
                        echo $list[1] + $prod[2]."<br>";
                        if($prod[3] < ($list[1] + $prod[2])){ //acaa
                            $bool = false;
                            //echo "ENTAAAAA";
                        }
                    }
                }
                //echo('<pre>');
                //var_dump($resList);
                //echo('</pre>');
                

        }
        
        return $bool;

    }

    public function getStockCant($cantidad){
        $carrito = new Carrito();
        $InProd = new IngredienteProducto($this -> idProducto);
        /*
         * [[FK_idProducto, FK_idIngrediente , IngredienteProducto.cantidad[2] , Ingrediente.cantidad[3] ]]
         */
        $ingredientesProd = $InProd -> buscarIngredientesProducto();

        $bool = true;

        foreach($ingredientesProd as $item){
            //echo $item[2]. " - ". $item[3] . "<br>";
            if(($item[2] * $cantidad) > $item[3]){
                //echo $item[1] . "<br>";
                $bool = false;
            }
        }

        if($bool){

            /*
                 *  Me devuelve objetos de tipo ingrediente producto en la posicion 0 con [[FK_idProducto, FK_idIngrediente, cantidad], cantidad_session]
                 */
                $ingredientesUsadosCarrito = $carrito -> ingredientesUsados($ingredientesProd);
                $resList = array();
                foreach($ingredientesUsadosCarrito as $prodIngre){
                    foreach($ingredientesProd as $newProd){
                        foreach($prodIngre[0] as $itemCarrito){
                            //var_dump($itemCarrito ->  getIngrediente());
                            
                            if($itemCarrito -> getIngrediente() == $newProd[1]){
                                $boolean = true;
                                for($i = 0; $i < count($resList); $i++){
                                    if($resList[$i][0] == $newProd[1]){
                                        $resList[$i][1] += $itemCarrito -> getCantidad()* $prodIngre[1];
                                        $boolean = false;
                                    }
                                }
                                if($boolean){
                                    array_push($resList, array($itemCarrito -> getIngrediente(), $itemCarrito -> getCantidad()* $prodIngre[1]));
                                }
                                
                            }
                        }
                    }
                }
                /*
                $ingredientesUsadosCarrito = $carrito -> ingredientesUsados($ingredientesProd);
                $resList = array();
                foreach($ingredientesUsadosCarrito as $prodIngre){
                    foreach($ingredientesProd as $newProd){
                        foreach($prodIngre[0] as $itemCarrito){
                            //var_dump($itemCarrito ->  getIngrediente());
                            
                            if($itemCarrito -> getIngrediente() == $newProd[1]){
                                array_push($resList, array($itemCarrito -> getIngrediente(), $itemCarrito -> getCantidad()* $prodIngre[1]));
                            }
                        }
                    }
                }
                */
                foreach($ingredientesProd as $prod){
                    foreach($resList as $list)
                    if($prod[1] == $list[0]){
                        //echo $list[1] + $prod[2]."<br>";
                        if($prod[3] < ($list[1] + ($prod[2]* $cantidad))){ //acaa
                            $bool = false;
                            //echo "ENTAAAAA";
                        }
                    }
                }
                //echo('<pre>');
                //var_dump($resList);
                //echo('</pre>');
                

        }
        
        return $bool;
    }

    public function getStockItemCart($cantidad){

        $carrito = new Carrito($this -> idProducto, $cantidad);
        $inPro = new IngredienteProducto($this -> idProducto);
        $bool = true;
        if($carrito -> checkCarrito()){

            $listaActualizada = $carrito -> copyTryCarrito();
            /**
             * [[obj FK_idProducto, FK_idIngrediente , cantidad * cantidad en carrito ]]
             */
            $ingredientesCarrito = $carrito -> checkIngredientesUsados($listaActualizada);
            //echo('<pre>');
            //foreach($ingredientesCarrito as $ingred){
            //    echo $ingred -> getIngrediente() ." - ". $ingred -> getCantidad(). "<br>";
            //}
            //echo('</pre>');
            /**
             * Ingredientes del producto a actualizar [[[OBJ]id, cantidad]]
             */
            $ingredientes = $inPro  -> buscarCantIngredientes();
            $resList = array();

            foreach($ingredientes as $ingre){
                foreach($ingredientesCarrito as $ingreCar){

                    if($ingre -> getIdIngrediente() == $ingreCar -> getIngrediente()){

                        $boolean = true;

                        for($i = 0; $i < count($resList); $i++){
                            if($resList[$i][0] == $ingre -> getIdIngrediente()){
                                $resList[$i][1] += $ingreCar -> getCantidad();
                                $boolean = false;
                            }
                        }

                        if($boolean){
                            array_push($resList, array($ingreCar -> getIngrediente(), $ingreCar -> getCantidad()));
                        }

                    }
                }
            }

            /*echo('<pre>');
            var_dump($resList);
            echo('</pre>');
            */
            foreach($ingredientes as $prod){
                foreach($resList as $list)
                if($prod -> getIdIngrediente() == $list[0]){
                    //echo $list[1] + $prod[2]."<br>";
                    if($prod -> getCantidad() < $list[1]){ //acaa
                        $bool = false;
                    }
                }
            }

        }else{
            $bool = $this ->getStockCant($cantidad);
        }

        return $bool;

    }

    public function checkOut(){

        $carrito = new Carrito();
        /**
             * [[obj FK_idProducto, FK_idIngrediente , cantidad * cantidad en carrito ]]
             */
        $productosCart = $carrito -> checkIngredientesUsados($_SESSION['carrito']);

        $arrJustProd = array();

        for($i = 0; $i < count($productosCart); $i++){
            $bool = true;
            for($j = 0; $j < count($arrJustProd); $j++){

                if($productosCart[$i] -> getIngrediente() == $arrJustProd[$j] -> getIngrediente()){
                    $arrJustProd[$j] -> setCantidad( $arrJustProd[$j] -> getCantidad() + $productosCart[$i] -> getCantidad());
                    $bool = false;
                }
            }
            if($bool){
                array_push($arrJustProd, $productosCart[$i]);
            }
        }

        /*echo('<pre>');
            var_dump($arrJustProd);
            echo('</pre>');
        */

        $boolean = true;

        foreach($arrJustProd as $item){
            $idIngrediente = $item -> getIngrediente();
            $ingrediente = new Ingrediente ($idIngrediente);
            $ingrediente -> getInfoBasic();

            if($item -> getCantidad() > $ingrediente -> getCantidad()){
                $boolean = false;
            }
        }

        return $boolean;

    }

    public function transaction(){
        $this -> Conexion -> abrir();

        $carrito = new Carrito();
        
        /**
             * [[obj FK_idProducto, FK_idIngrediente , cantidad * cantidad en carrito ]]
             */
        $productosCart = $carrito -> checkIngredientesUsados($_SESSION['carrito']);

        $arrJustProd = array();

        for($i = 0; $i < count($productosCart); $i++){
            $bool = true;
            for($j = 0; $j < count($arrJustProd); $j++){

                if($productosCart[$i] -> getIngrediente() == $arrJustProd[$j] -> getIngrediente()){
                    $arrJustProd[$j] -> setCantidad( $productosCart[$i] -> getCantidad() + $arrJustProd[$j] -> getCantidad());
                    $bool = false;
                }
            }
            if($bool){
                array_push($arrJustProd, $productosCart[$i]);
            }
        }

        /*foreach($arrJustProd as $elem){

            echo $elem -> getIngrediente(). " - ". $elem -> getCantidad() . "<br>";

        }*/


        $alertIngre = 1;

        foreach($arrJustProd as $ingre){
            $newIngre = new Ingrediente($ingre -> getIngrediente());
            $newIngre -> getInfoBasic();
            //echo "<br>".$newIngre -> getCantidad()." - ".$ingre -> getCantidad(). "<br>";
            $newIngre -> setCantidad( $newIngre -> getCantidad() - $ingre -> getCantidad());
            //echo "<br> cantidad". $newIngre -> getCantidad(). "<br>";
            
            $alert = $newIngre -> actualizarCantidad();
            if($alert != 1){
                $alertIngre = 0;
            }
        }
        $date = new DateTime();

        $listaProd = $carrito -> searchCarritoItems();

        $factura = new Factura("", $date -> format('Y-m-d H:i:s'), $carrito -> getTotalPriceList($listaProd), $_SESSION['id']);
        
        $alertFact = $factura -> crearFactura();

        $listCarritoComplete = $_SESSION['carrito'];

        $alertProdFact = 1;


        foreach($listCarritoComplete as $item){
            $prod =  new Producto($item[0]);
            $prod -> getInfoBasic();
            $FacProd = new FacturaProducto($factura -> getIdFactura(), $prod -> getIdProducto(), $item[1], $prod -> getPrecio());
            
            $alert = $FacProd -> agregar();
            if($alert != 1){
                $alertProdFact = 0;
            }
        }

        

        if($alertProdFact == 1 && $alertFact == 1 && $alertIngre == 1){
            $this -> Conexion -> rollbackTransaction();
            $bool = true;
        }else{
            $this -> Conexion -> rollbackTransaction();
            $bool = false;
        }
        echo $alertProdFact ." - " . $alertFact ." - " . $alertIngre;
        //var_dump($bool);

        return $bool;
        
    }
}


?>
