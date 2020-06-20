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

    public function getInfo(){
        return "SELECT idProducto, Producto.nombre, foto, descripcion, precio, Categoria.nombre as categoria 
                FROM Producto 
                INNER JOIN Categoria 
                ON FK_idCategoria = idCategoria 
                WHERE idProducto = ". $this -> idProducto;
    }
}


?>