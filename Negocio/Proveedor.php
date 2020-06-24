<?php 

require_once "Persistencia/Conexion.php";
require_once "Persistencia/ProveedorDAO.php";

class Proveedor{
    private $idProveedor;
    private $nit;
    private $nombre;
    private $telefono;
    private $direccion;

    private $ProveedorDAO;
    private $Conexion;

    public function Proveedor($idProveedor = "", $nit = "", $nombre = "", $telefono = "", $direccion = ""){
        $this -> idProveedor = $idProveedor;
        $this -> nit = $nit;
        $this -> nombre = $nombre;
        $this -> telefono = $telefono;
        $this -> direccion = $direccion;

        $this -> ProveedorDAO = new ProveedorDAO($this -> idProveedor, $this -> nit, $this -> nombre, $this -> telefono, $this -> direccion);
        $this -> Conexion = new Conexion(); 

    }

    /*GETS*/

    public function getIdProveedor(){
        return $this -> idProveedor;
    }

    public function getNit(){
        return $this -> nit;
    }

    public function getNombre(){
        return $this -> nombre;
    }

    public function getTelefono(){
        return $this -> telefono;
    }

    public function getDireccion(){
        return $this -> direccion;
    }

    /* SETS */

    public function setIdProveedor($idProveedor){
        $this -> idProveedor = $idProveedor;
    }

    public function setNit($nit){
        $this -> nit = $nit;
    }

    public function setNombre($nombre){
        $this -> idNombre = $nombre;
    }

    public function setTelefono($telefono){
        $this -> telefono = $telefono;
    }

    public function setDireccion($direccion){
        $this -> direccion = $direccion;
    }

    /*Methods*/

    /*
     * Obtener información del objeto
     */

    public function getInfo(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ProveedorDAO -> getInfo());
        $res = $this -> Conexion -> extraer();
        $this -> nit = $res[1];
        $this -> nombre = $res[2];
        $this -> telefono = $res[3];
        $this -> direccion = $res[4];
        $this -> Conexion -> cerrar();
    }

    /*
     * Inserta en la base de datos a un nuevo proveedor
     */

    public function insertar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ProveedorDAO -> insertar());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /*
     * Función que busca por paginación y devuelve n objetos de tipo Proveedor en un array
     */
    public function buscarPaginado($pag, $cant){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ProveedorDAO -> buscarPaginado($pag, $cant));
        $resList = Array();
        while($res = $this -> Conexion -> extraer()){
            array_push($resList, new Proveedor($res[0], $res[1], $res[2], $res[3], $res[4]));
        }
        $this -> Conexion -> cerrar();

        return $resList;
    }

    /*
     * Busca la cantidad de registros sin ningun filtro
     */
    public function buscarCantidad(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ProveedorDAO -> buscarCantidad());
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();
        return $res[0];
    }

    /*
     * Función que busca por paginación, filtro de palabra y devuelve la información en un array
     */
    public function filtroPaginado($str, $pag, $cant){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ProveedorDAO -> filtroPaginado($str, $pag, $cant));
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
        $this -> Conexion -> ejecutar( $this -> ProveedorDAO -> filtroCantidad($str));
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();
        return $res[0];
    }

    /*
     * Actualiza un proveedor con los datos provenientes del cliente
     */
    public function actualizarProveedor(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ProveedorDAO -> actualizarProveedor());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /*
     * Busca todos los elementos que existen de producto
     */
    public function buscarTodo(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> ProveedorDAO -> buscarTodo());
        $resList = array();
        while($res = $this -> Conexion -> extraer()){
            array_push($resList, new Proveedor($res[0], "", $res[1]));
        }
        $this -> Conexion -> cerrar();
        return $resList;
    }

}

?>