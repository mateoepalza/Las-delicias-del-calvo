<?php 

require_once "Persistencia/Conexion.php";
require_once "Persistencia/ClienteDAO.php";

class Cliente{
    private $idCliente;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $foto;
    private $estado;
    private $activacion;
    private $ClienteDAO;
    private $conexion;

    public function Cliente($idCliente = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $foto = "", $estado = "", $activacion = ""){
        $this -> idCliente = $idCliente;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> foto = $foto;
        $this -> estado = $estado;
        $this -> activacion = $activacion;
        $this -> ClienteDAO = new ClienteDAO($idCliente, $nombre, $apellido, $correo, $clave, $foto, $estado, $activacion);
        $this -> conexion = new Conexion();
    }
    /*
    *   Getters
    */
    public function getIdCliente(){
        return $this -> idCliente;
    }

    public function getNombre(){
        return $this -> nombre;
    }

    public function getApellido(){
        return $this -> apellido;
    }

    public function getCorreo(){
        return $this -> correo;
    }

    public function getClave(){
        return $this -> clave;
    }

    public function getFoto(){
        return $this -> foto;
    }
    public function getEstado(){
        return $this -> estado;
    }
    public function getActivacion(){
        return $this -> Activacion;
    }

    /*
    *   Setters
    */
    public function setIdCliente($idCliente){
        $this -> idCliente = $idCliente;
    }

    public function setNombre($nombre){
        $this -> nombre = $nombre;
    }

    public function setApellido($apellido){
        $this -> apellido = $apellido;
    }

    public function setCorreo($correo){
        $this -> correo = $correo;
    }

    public function setClave($clave){
        $this -> clave = $clave;
    }

    public function setFoto($foto){
        $this -> foto = $foto;
    }
    public function setEstado($estado){
        $this -> Estado = $estado;
    }
    public function setActivacion($activacion){
        $this -> Activacion = $activacion;
    }
    public function setConexion($Conexion){
        $this -> conexion = $Conexion;
    }
    /* 
    *   methods
    */


    /**
     * Insertar un nuevo Inventarisa
     */
    public function insertar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> ClienteDAO -> insertar());
        $res = $this -> conexion -> filasAfectadas();
        $this -> conexion -> cerrar();
        return $res;
    }

    /*
     * Actualiza la información del objeto sin actualizar la contraseña
     */
    public function actualizar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> ClienteDAO -> actualizar());
        $res = $this -> conexion -> filasAfectadas();
        $this -> conexion -> cerrar();
        return $res;
    }

    /*
     * Actualiza la información básica del objeto sin actualizar la contraseña
     */
    public function actualizarBasic(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> ClienteDAO -> actualizarBasic());
        $res = $this -> conexion -> filasAfectadas();
        $this -> conexion -> cerrar();
        return $res;
    }

    /**
     * Actualiza la contraseña del cliente
     */

    public function actualizarClave($nuevaClave){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> ClienteDAO -> actualizarClave($nuevaClave));
        $res = $this -> conexion -> filasAfectadas();
        $this -> conexion -> cerrar();
        return $res;
    }

    /**
     * Actualiza la información del objeto actualizando la contraseña
     */
    public function actualizarCClave(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> ClienteDAO -> actualizarCClave());
        $res = $this -> conexion -> filasAfectadas();
        $this -> conexion -> cerrar();
        return $res;
    }

    /**
     * Check clave
     */

    public function checkClave(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> ClienteDAO -> checkClave());    
        $this -> conexion -> cerrar();
        if($this -> conexion -> numFilas() == 1){
            return true;
        }else{
            return false;
        }
    }

    public function autenticar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> ClienteDAO -> autenticar());
        if($this -> conexion -> numFilas() == 1){
            $res = $this -> conexion -> extraer();
            $this -> idCliente = $res[0];
            $this -> nombre = $res[1];
            $this -> apellido = $res[2];
            $this -> foto = $res[3];
            $this -> estado = $res[4];
            $this -> activacion = $res[5];

            return True;
        }else{
            return False;
        }
        $this -> conexion -> cerrar();
    }

    /**
     * Buscar si un correo ya existe
     */

    public function existeCorreo(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> ClienteDAO -> existeCorreo());
        $this -> conexion -> cerrar();
        return $this -> conexion -> numFilas();
    }

    public function existeNuevoCorreo($correo){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> ClienteDAO -> existeNuevoCorreo($correo));
        $this -> conexion -> cerrar();
        return $this -> conexion -> numFilas();
    }

    /**
     * Registro de un nuevo cliente
     */

    public function registrar(){
        $this -> conexion -> abrir();
        $codigoActivacion = rand(1000,9999);
        $this -> conexion -> ejecutar( $this -> ClienteDAO -> registrar($codigoActivacion));
        $res = $this -> conexion -> filasAfectadas();
        $this -> conexion -> cerrar();       
        $url = "http://127.0.0.1/Las-delicias-del-calvo/index.php?pid=" . base64_encode("Vista/Auth/clienteActivarCuenta.php") . "&email=" . base64_encode($this -> correo) . "&cod=" . base64_encode($codigoActivacion);
        //echo $url;
        /*$correo = new Correo(
            $this -> correo, 
            "deliciasCalvo@chefBogota.com",
            "Delicias del calvo - recuerde ingresar apara poder activar su cuenta con nosotros",
            "Recuerde activar su cuenta con nosotros, por favor vaya a la siguiente dirección " . $url, 
            "deliciasCalvo@chefBogota.com",
            "deliciasCalvo@chef.com"
        );
        $correo -> send();*/
        echo $url;
        return $res;
    }

    /**
     * Activar cuenta de cliente
     */
    public function verificarActivacion($codActivacion){
        $this-> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> ClienteDAO -> verificarActivacion($codActivacion));
        if($this -> conexion -> numFilas()){
            $this -> conexion -> ejecutar( $this -> ClienteDAO -> activacion());
            $this -> conexion -> cerrar();
            return true;
        }else{
            $this -> conexion -> cerrar();
            return false;
        }
    }

    /*
     * Función que busca por paginación y devuelve n objetos de tipo Producto en un array
     */
    public function buscarPaginado($pag, $cant){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> ClienteDAO -> buscarPaginado($pag, $cant));
        $resList = Array();
        while($res = $this -> conexion -> extraer()){
            array_push($resList, new Cliente($res[0], $res[1], $res[2], $res[3], $res[4], $res[5], $res[6]));
        }
        $this -> conexion -> cerrar();

        return $resList;
    }

    /*
     * Busca la cantidad de registros sin ningun filtro
     */
    public function buscarCantidad(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> ClienteDAO -> buscarCantidad());
        $res = $this -> conexion -> extraer();
        $this -> conexion -> cerrar();
        return $res[0];
    }

    /*
     * Función que busca por paginación, filtro de palabra y devuelve la información en un array
     */
    public function filtroPaginado($str, $pag, $cant){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> ClienteDAO -> filtroPaginado($str, $pag, $cant));
        $resList = Array();
        while($res = $this -> conexion -> extraer()){
            array_push($resList, $res);
        }
        $this -> conexion -> cerrar();

        return $resList;
    }

    /*
     * Busca la cantidad de registros con filtro de palabra
     */
    public function filtroCantidad($str){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> ClienteDAO -> filtroCantidad($str));
        $res = $this -> conexion -> extraer();
        $this -> conexion -> cerrar();

        return $res[0];
    }

    /*
     * Función que busca por paginación y devuelve la información en un array
     */
    public function buscarAPaginado($pag, $cant){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> ClienteDAO -> buscarPaginado($pag, $cant));
        $resList = Array();
        while($res = $this -> conexion -> extraer()){
            array_push($resList, $res);
        }
        $this -> conexion -> cerrar();

        return $resList;
    }

    /*
     * Función que actualiza el estado de un cliente
     */
    public function updateEstado(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> ClienteDAO -> updateEstado());
        $res = $this -> conexion -> filasAfectadas();
        $this -> conexion -> cerrar();
        return $res;
    }

    public function getInfoBasic(){

        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> ClienteDAO -> getInfoBasic() );
        $res = $this -> conexion -> extraer();
        
        /* Actualzar OBJ*/
        $this -> nombre = $res[1];
        $this -> apellido = $res[2];
        $this -> correo = $res[3];
        $this -> clave = $res[4];
        $this -> foto = $res[5];
        $this -> estado = $res[6];
        
        /* FIN Actualzar OBJ*/
        $this -> conexion -> cerrar();
    }
}
?>