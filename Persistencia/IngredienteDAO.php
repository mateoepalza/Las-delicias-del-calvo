<?php

class IngredienteDAO{

    private $idIngrediente;
    private $nombre;
    private $cantidad;
    private $proveedor;

    public function IngredienteDAO($idIngrediente = "", $nombre = "", $cantidad = "", $proveedor = ""){

        $this -> idIngrediente = $idIngrediente;
        $this -> nombre = $nombre;
        $this -> cantidad = $cantidad;
        $this -> proveedor = $proveedor;
    }

    public function insertar(){
        return "INSERT INTO Ingrediente (nombre, cantidad, FK_idProveedor) 
                VALUES ('" . $this -> nombre . "','" . $this -> cantidad . "','" . $this -> proveedor . "')";
    }

    public function getInfoBasic(){
        return "SELECT idIngrediente, Ingrediente.nombre, cantidad, FK_idProveedor
                FROM Ingrediente
                WHERE idIngrediente = ". $this -> idIngrediente;
    }

    public function buscarPaginado($pag, $cant){
        return "SELECT idIngrediente, Ingrediente.nombre, cantidad, Proveedor.nombre as proveedor
                FROM Ingrediente
                INNER JOIN Proveedor 
                ON FK_idProveedor = idProveedor 
                LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
    }

    public function buscarCantidad(){
        return "SELECT count(*) 
                FROM Ingrediente";
    }

    public function filtroPaginado($str, $pag, $cant){
        return "SELECT idIngrediente, Ingrediente.nombre, cantidad, Proveedor.nombre as proveedor
                FROM Ingrediente
                INNER JOIN Proveedor 
                ON FK_idProveedor = idProveedor
                WHERE Ingrediente.nombre like '%". $str ."%' 
                LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
    }

    public function filtroCantidad($str){
        return "SELECT count(*) 
                FROM Ingrediente
                WHERE Ingrediente.nombre like '%" . $str . "%'";
    }

    public function actualizarIngrediente(){
        return "UPDATE Ingrediente 
                SET
                    nombre = '" . $this -> nombre . "',
                    cantidad = '" . $this -> cantidad . "',
                    FK_idProveedor = '" . $this -> proveedor . "'
                WHERE idIngrediente = ". $this -> idIngrediente;
    }

    public function buscarTodo(){
        return "SELECT idIngrediente, Ingrediente.nombre, cantidad, FK_idProveedor
                FROM Ingrediente";
    }

}
?>