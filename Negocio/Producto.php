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

    public function insertar(){
        $this -> Conexion -> abrir();
        echo $this -> ProductoDAO -> insertar();
        $this -> Conexion -> ejecutar( $this -> ProductoDAO -> insertar() );
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    public function guardarImagen($tempName, $ruta){
        //$ruta = $ruta + rand(0,10000000);
        return  @move_uploaded_file($tempName, $ruta);
    }

}


?>
