<?php
class ProductoDAO{
    private $idProducto;
    private $nombre;
    private $foto;
    private $descripcion;
    private $precio;
    private $categoria;

    public function ProductoDAO($idProducto = "", $nombre = "", $foto = "", $descripcion = "", $precio = "", $categoria = ""){
        $this -> idProducto = $idProducto;
        $this -> nombre = $nombre;
        $this -> foto = $foto;
        $this -> descripcion = $descripcion;
        $this -> precio = $precio;
        $this -> categoria = $categoria;
        
    }

    /*Methods*/

    public function insertar(){
        return "INSERT INTO Producto (nombre, foto, descripcion, precio, FK_idCategoria)
                VALUES ('" . $this -> nombre . "', '" . $this -> foto . "', '" . $this -> descripcion . "', '" . $this -> precio . "', '" . $this -> categoria . "')";
    }

    /*
     * Función que busca los productos destacados
     */
    public function getDestProducts(){
        return "SELECT idProducto, nombre, foto, precio
                FROM producto
                LIMIT 0, 10";
    }

    /*
     * 
     */

    public function getProductsByCategory($category){
        return "SELECT idProducto, nombre, foto, precio
                FROM producto
                WHERE FK_idCategoria = " . $category . "
                LIMIT 0, 15";
    }

    public function buscarPaginado($pag, $cant){
        return "SELECT idProducto, Producto.nombre, foto, descripcion, precio,  Categoria.nombre as categoria 
                FROM Producto 
                INNER JOIN Categoria 
                ON FK_idCategoria = idCategoria 
                LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
    }

    public function buscarCantidad(){
        return "SELECT count(*) 
                FROM Producto";
    }

    public function filtroPaginado($str, $pag, $cant){
        return "SELECT idProducto, Producto.nombre, precio,  Categoria.nombre as categoria 
                FROM Producto 
                INNER JOIN Categoria 
                ON FK_idCategoria = idCategoria 
                WHERE Producto.nombre like '%". $str ."%'
                LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
    }

    public function filtroCantidad($str){
        return "SELECT count(*) 
                FROM Producto
                WHERE nombre like '%" . $str . "%'";
    }
    
    public function getInfo(){
        return "SELECT idProducto, Producto.nombre, foto, descripcion, precio, Categoria.idCategoria, Categoria.nombre as categoria 
                FROM Producto 
                INNER JOIN Categoria 
                ON FK_idCategoria = idCategoria 
                WHERE idProducto = ". $this -> idProducto;
    }

    public function actualizarProducto(){
        return "UPDATE producto
                SET 
                    nombre = '". $this -> nombre ."',
                    foto = '". $this -> foto ."',
                    descripcion = '". $this -> descripcion ."',
                    precio = ". $this -> precio .",
                    FK_idCategoria =". $this -> categoria. "
                WHERE idProducto = ". $this -> idProducto;
    }
}


?>