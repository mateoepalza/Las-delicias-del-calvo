<?php

    require_once "Persistencia/Conexion.php";
    require_once "Persistencia/IngredienteDAO.php";

class Ingrediente{

    private $idIngrediente;
    private $nombre;
    private $cantidad;
    private $proveedor;

    private $IngredienteDAO;
    private $Conexion;

    public function Ingrediente($idIngrediente = "", $nombre = "", $cantidad = "", $proveedor = ""){

        $this -> idIngrediente = $idIngrediente;
        $this -> nombre = $nombre;
        $this -> cantidad = $cantidad;
        $this -> proveedor = $proveedor;

        $this -> IngredienteDAO = new IngredienteDAO($this -> idIngrediente, $this -> nombre, $this -> cantidad, $this ->proveedor);
        $this -> Conexion = new Conexion();
    }

    /*GETS*/

    public function getIdIngrediente(){
        return $this -> idIngrediente;
    }

    public function getNombre(){
        return $this -> nombre;
    }

    public function getCantidad(){
        return $this -> cantidad;
    }

    public function getProveedor(){
        return $this -> proveedor;
    }

    /*SETS*/

    public function setIdIngrediente($idIngrediente){
        $this -> idIngrediente = $idIngrediente;
        $this -> IngredienteDAO -> setIdIngrediente($idIngrediente);
    }

    public function setNombre($nombre){
        $this -> nombre = $nombre;
        $this -> IngredienteDAO -> setNombre($nombre);
    }

    public function setCantidad($cantidad){
        $this -> cantidad = $cantidad;
        $this -> IngredienteDAO -> setCantidad($cantidad);
    }

    public function setProveedor($proveedor){
        $this -> proveedor = $proveedor;
        $this -> IngredienteDAO -> setProveedor($proveedor);
    }
    public function setConexion($Conexion){
        $this -> Conexion = $Conexion;
    }
    
    /*Methods*/

    public function insertar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> IngredienteDAO -> insertar());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /*
     * función que obtiene toda la información del ingrediente que corresponde
     * al atributo $idIngrediente
     */

    public function getInfoBasic(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> IngredienteDAO -> getInfoBasic());
        $res = $this -> Conexion -> extraer();
        $this -> nombre = $res[1];
        $this -> cantidad = $res[2];
        $this -> proveedor = $res[3];
        $this -> Conexion -> cerrar();
        return $res;
    }

    /*
     *  Obtengo todos los registros de Ingerdientes existentes
     */

    public function buscarTodo(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> IngredienteDAO -> buscarTodo());
        $resLista = array();
        while($res = $this -> Conexion -> extraer()){
            array_push($resLista, new Ingrediente($res[0], $res[1], $res[2], $res[3]));
        }
        $this -> Conexion -> cerrar();
        return $resLista;
    }

    /*
     * Función que actualiza toda la información del ingrediente
     */

    public function actualizarIngrediente(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> IngredienteDAO -> actualizarIngrediente());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /*
     * Función que actualiza toda la información del ingrediente
     */

    public function actualizarCantidad(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> IngredienteDAO -> actualizarCantidad());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /*
     * Función que busca por paginación y devuelve n objetos de tipo Ingrediente en un array
     */
    public function buscarPaginado($pag, $cant){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> IngredienteDAO -> buscarPaginado($pag, $cant));
        $resList = Array();
        while($res = $this -> Conexion -> extraer()){
            array_push($resList, new Ingrediente($res[0], $res[1], $res[2], $res[3]));
        }
        $this -> Conexion -> cerrar();

        return $resList;
    }

    /*
     * Busca la cantidad de registros sin ningun filtro
     */
    public function buscarCantidad(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> IngredienteDAO -> buscarCantidad());
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();
        return $res[0];
    }

    /*
     * Función que busca por paginación, filtro de palabra y devuelve la información en un array
     */
    public function filtroPaginado($str, $pag, $cant){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> IngredienteDAO -> filtroPaginado($str, $pag, $cant));
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
        $this -> Conexion -> ejecutar( $this -> IngredienteDAO -> filtroCantidad($str));
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();
        return $res[0];
    }
}
?>