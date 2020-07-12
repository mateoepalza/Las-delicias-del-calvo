<?php 

    require_once "Persistencia/Conexion.php";
    require_once "Persistencia/AdministradorDAO.php";

class Administrador{
    private $idAdministrador;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $foto;
    private $AdministradorDAO;
    private $conexion;

    public function Administrador($idAdministardor = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $foto = ""){
        $this -> idAdministrador = $idAdministardor;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> foto = $foto;
        $this -> AdministradorDAO = new AdministradorDAO($idAdministardor, $nombre, $apellido, $correo, $clave, $foto);
        $this -> conexion = new Conexion();
    }
    /*
    *   Getters
    */
    public function getIdAdministrador(){
        return $this -> idAdministrador;
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

    /*
    *   Setters
    */
    public function setIdAdministrador($idAdministardor){
        $this -> idAdministrador = $idAdministardor;
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
        $this -> Foto = $foto;
    }
    public function setConexion($Conexion){
        $this -> conexion = $Conexion;
    }
    /* 
    *   Functions
    */

    public function autenticar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> AdministradorDAO -> autenticar());
        //$this -> conexion -> cerrar();

        if($this -> conexion -> numFilas() == 1){
            $res = $this -> conexion -> extraer();
            $this -> idAdministrador = $res[0];
            return True;
        }else{
            return False;
        }
    }

    public function getInfoBasic(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> AdministradorDAO -> getInfoBasic() );
        $res = $this -> conexion -> extraer();
        /* Actualzar OBJ*/
        $this -> nombre = $res[1];
        $this -> apellido = $res[2];
        $this -> correo = $res[3];
        $this -> clave = $res[4];
        $this -> foto = $res[5];
        /* FIN Actualzar OBJ*/
        $this -> conexion -> cerrar();
    }

    /**
     * Actualizar administrador
     */

    public function actualizarAdministrador(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> AdministradorDAO -> actualizarAdministrador());
        $res = $this -> conexion -> filasAfectadas();
        $this -> conexion -> cerrar();
        return $res;
    }

    /**
     * Actualiza la contraseña del cliente
     */
    public function actualizarClave($nuevaClave){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> AdministradorDAO -> actualizarClave($nuevaClave));
        $res = $this -> conexion -> filasAfectadas();
        $this -> conexion -> cerrar();
        return $res;
    }

    /**
     * Check clave
     */
    public function checkClave(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> AdministradorDAO -> checkClave());    
        $this -> conexion -> cerrar();
        if($this -> conexion -> numFilas() == 1){
            return true;
        }else{
            return false;
        }
    }

    public function existeCorreo(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> AdministradorDAO -> existeCorreo());
        $this -> conexion -> cerrar();
        return $this -> conexion -> numFilas();
    }

    public function existeNuevoCorreo($correo){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> AdministradorDAO -> existeNuevoCorreo($correo));
        $this -> conexion -> cerrar();
        return $this -> conexion -> numFilas();
    }

    /*
     * Función que busca por paginación y devuelve n objetos de tipo Producto en un array
     */
    public function buscarPaginado($pag, $cant){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> AdministradorDAO -> buscarPaginado($pag, $cant));
        $resList = Array();
        while($res = $this -> conexion -> extraer()){
            array_push($resList, new Administrador($res[0], $res[1], $res[2], $res[3]));
        }
        $this -> conexion -> cerrar();

        return $resList;
    }

    /*
     * Busca la cantidad de registros sin ningun filtro
     */
    public function buscarCantidad(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> AdministradorDAO -> buscarCantidad());
        $res = $this -> conexion -> extraer();
        $this -> conexion -> cerrar();
        return $res[0];
    }

    /**
     * Crear un nuevo administrador
     */
    public function insertar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> AdministradorDAO -> insertar());
        $res = $this -> conexion -> filasAfectadas();
        $this -> conexion -> cerrar();
        return $res;
    }

    /*
     * Función que busca por paginación, filtro de palabra y devuelve la información en un array
     */
    public function filtroPaginado($str, $pag, $cant){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> AdministradorDAO -> filtroPaginado($str, $pag, $cant));
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
        $this -> conexion -> ejecutar( $this -> AdministradorDAO -> filtroCantidad($str));
        $res = $this -> conexion -> extraer();
        $this -> conexion -> cerrar();

        return $res[0];
    }
}

?>