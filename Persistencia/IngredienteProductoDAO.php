<?php 

class IngredienteProductoDAO{
    private $producto;
    private $ingrediente;
    private $cantidad;

    public function IngredienteProductoDAO ($producto = "", $ingrediente ="", $cantidad){
        $this -> producto = $producto;
        $this -> ingrediente = $ingrediente;
        $this -> cantidad = $cantidad;
    }

    public function buscarIngredientes(){
        return "SELECT FK_idProducto as producto, FK_idIngrediente as ingrediente, Ingrediente.nombre, IngredienteProducto.cantidad 
                FROM IngredienteProducto
                INNER JOIN Ingrediente
                    ON FK_idIngrediente = idIngrediente
                WHERE FK_idProducto = ". $this -> producto;
    }

    public function buscarIngredienteOb(){
        return "SELECT FK_idProducto, FK_idIngrediente , cantidad 
        FROM IngredienteProducto
        WHERE FK_idProducto = ". $this -> producto;
    }

    public function buscarIngredientesProducto(){
        return "SELECT FK_idProducto, FK_idIngrediente , IngredienteProducto.cantidad , Ingrediente.cantidad 
                FROM IngredienteProducto
                INNER JOIN Ingrediente
                    ON FK_idIngrediente = idIngrediente
                WHERE FK_idProducto = ". $this -> producto;
    }

    public function buscarIngrediente(){
        return "SELECT FK_idProducto as producto, FK_idIngrediente as ingrediente, Ingrediente.nombre, IngredienteProducto.cantidad 
                FROM IngredienteProducto
                INNER JOIN Ingrediente
                    ON FK_idIngrediente = idIngrediente
                WHERE FK_idProducto = ". $this -> producto . " AND FK_idIngrediente = " . $this -> ingrediente ;
    }

    public function eliminar(){
        return "DELETE FROM IngredienteProducto
                WHERE FK_idProducto = '" . $this -> producto . "' AND FK_idIngrediente = '" . $this -> ingrediente . "'";
    }

    public function agregar(){
        return "INSERT INTO IngredienteProducto (FK_idProducto, FK_idIngrediente, cantidad)
                VALUES ('" . $this -> producto . "','" . $this -> ingrediente . "','" . $this -> cantidad ."')";
    }

    public function actualizar(){
        return "UPDATE IngredienteProducto 
                SET
                    cantidad = '" . $this -> cantidad . "'
                WHERE FK_idProducto = '" . $this -> producto . "' AND FK_idIngrediente = '" . $this -> ingrediente . "'";
    }
}
?>