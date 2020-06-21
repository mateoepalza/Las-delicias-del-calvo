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

    public function insertar(){
        $this -> Conexion -> abrir();
        echo $this -> ProductoDAO -> insertar();
        $this -> Conexion -> ejecutar( $this -> ProductoDAO -> insertar() );
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
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
     * Busca la cantidad de registros con filtro de palabra
     */
    public function filtroCantidad($str){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ProductoDAO -> filtroCantidad($str));
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
        var_dump($res);
        $this -> Conexion -> cerrar();
        return $res;
    }
}


?>
