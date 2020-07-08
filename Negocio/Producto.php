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

    public function cantIngrediente(){
        $Ingre = new IngredienteProducto($this -> idProducto);
        return $Ingre -> cantIngredientesProducto();
    }
}


?>
