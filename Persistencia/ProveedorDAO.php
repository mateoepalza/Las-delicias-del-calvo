<?php
class ProveedorDAO{
    private $idProveedor;
    private $nit;
    private $nombre;
    private $telefono;
    private $direccion;

    public function ProveedorDAO($idProveedor = "", $nit = "", $nombre = "", $telefono = "", $direccion = ""){
        $this -> idProveedor = $idProveedor;
        $this -> nit = $nit;
        $this -> nombre = $nombre;
        $this -> telefono = $telefono;
        $this -> direccion = $direccion;
    }

    public function insertar(){
        return "INSERT INTO Proveedor (nit, nombre, telefono, direccion)
                VALUES ('" . $this -> nit . "','" . $this -> nombre ."','" . $this -> telefono ."','" . $this -> direccion ."')";
    }

    public function buscarPaginado($pag, $cant){
        return "SELECT idProveedor, nit, nombre, telefono, direccion
                FROM Proveedor
                LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
    }

    public function buscarCantidad(){
        return "SELECT count(*) 
                FROM Proveedor";
    }

    public function filtroPaginado($str, $pag, $cant){
        return "SELECT idProveedor, nit, nombre, telefono, direccion
                FROM Proveedor 
                WHERE nombre like '%". $str ."%' OR nit like '%". $str ."%'
                LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
    }

    public function filtroCantidad($str){
        return "SELECT count(*) 
                FROM Proveedor
                WHERE nombre like '%". $str ."%' OR nit like '%". $str ."%'";
    }

    public function getInfo(){
        return "SELECT idProveedor, nit, nombre, telefono, direccion
                FROM Proveedor
                WHERE idProveedor = " . $this -> idProveedor;
    }

    public function actualizarProveedor(){
        return "UPDATE Proveedor
                SET
                    nit = '" . $this -> nit . "',
                    nombre = '" . $this -> nombre ."',
                    telefono = '" . $this -> telefono ."',
                    direccion = '" . $this -> direccion ."'
                WHERE idProveedor = ". $this -> idProveedor;
    }

    public function buscarTodo(){
        return "SELECT idProveedor, nombre
                FROM Proveedor";
    }
}
?>