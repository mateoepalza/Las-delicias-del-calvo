<?php

require_once "Persistencia/Conexion.php";
require_once "Persistencia/InventaristaDAO.php";

class Inventarista
{

    private $idInventarista;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $foto;
    private $estado;

    private $InventaristaDAO;
    private $Conexion;

    public function Inventarista($idInventarista = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $foto = "", $estado = "")
    {
        $this->idInventarista = $idInventarista;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->clave = $clave;
        $this->foto = $foto;
        $this->estado = $estado;

        $this->InventaristaDAO = new InventaristaDAO($this->idInventarista, $this->nombre, $this->apellido, $this->correo, $this->clave, $this->foto, $this->estado);
        $this->Conexion = new Conexion();
    }
    /*
        *   Getters
        */
    public function getIdInventarista(){
        return $this->idInventarista;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function getClave(){
        return $this->clave;
    }

    public function getFoto(){
        return $this->foto;
    }

    public function getEstado(){
        return $this->estado;
    }


    /*
        *   Setters
        */
    public function setIdInventarista($idInventarista)
    {
        $this->idCliente = $idInventarista;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    public function setClave($clave)
    {
        $this->clave = $clave;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
    }
    public function setEstado($estado)
    {
        $this->Estado = $estado;
    }

    /* methods */

    /**
     * Check clave
     */

    public function checkClave(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> InventaristaDAO -> checkClave());    
        $this -> Conexion -> cerrar();
        if($this -> Conexion -> numFilas() == 1){
            return true;
        }else{
            return false;
        }
    }

    public function autenticar(){
        $this->Conexion->abrir();
        $this->Conexion->ejecutar($this->InventaristaDAO->autenticar());
        if ($this->Conexion->numFilas() == 1) {
            $res = $this->Conexion->extraer();
            $this->idInventarista = $res[0];
            $this->nombre = $res[1];
            $this->apellido = $res[2];
            $this->foto = $res[3];
            $this->estado = $res[4];

            return True;
        } else {
            return False;
        }
        $this->conexion->cerrar();
    }

    public function getInfoBasic(){

        $this->Conexion->abrir();
        $this->Conexion->ejecutar( $this -> InventaristaDAO -> getInfoBasic());
        $res = $this->Conexion->extraer();

        $this->idInventarista = $res[0];
        $this->nombre = $res[1];
        $this->apellido = $res[2];
        $this->correo = $res[3];
        $this->foto = $res[5];
        $this->estado = $res[6];

        $this->Conexion->cerrar();

    }

    /*
     * Función que busca por paginación y devuelve n objetos de tipo Producto en un array
     */
    public function buscarPaginado($pag, $cant){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> InventaristaDAO -> buscarPaginado($pag, $cant));
        $resList = Array();
        while($res = $this -> Conexion -> extraer()){
            array_push($resList, new Inventarista($res[0], $res[1], $res[2], $res[3], $res[4], $res[5], $res[6]));
        }
        $this -> Conexion -> cerrar();

        return $resList;
    }

    /*
     * Busca la cantidad de registros sin ningun filtro
     */
    public function buscarCantidad(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> InventaristaDAO -> buscarCantidad());
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();
        return $res[0];
    }

    /*
     * Función que busca por paginación, filtro de palabra y devuelve la información en un array
     */
    public function filtroPaginado($str, $pag, $cant){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> InventaristaDAO -> filtroPaginado($str, $pag, $cant));
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
        $this -> Conexion -> ejecutar( $this -> InventaristaDAO -> filtroCantidad($str));
        $res = $this -> Conexion -> extraer();
        $this -> Conexion -> cerrar();

        return $res[0];
    }

    /*
     * Función que actualiza el estado de un cliente
     */
    public function updateEstado(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> InventaristaDAO -> updateEstado());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /*
     * Actualiza la información del objeto sin actualizar la contraseña
     */
    public function actualizar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> InventaristaDAO -> actualizar());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /**
     * Actualiza la información del objeto actualizando la contraseña
     */
    public function actualizarCClave(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> InventaristaDAO -> actualizarCClave());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /**
     * Insertar un nuevo Inventarisa
     */
    public function insertar(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> InventaristaDAO -> insertar());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /**
     * Actualiza la contraseña del cliente
     */
    public function actualizarClave($nuevaClave){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> InventaristaDAO -> actualizarClave($nuevaClave));
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    /**
     * Actualiza 
     */
    public function actualizarInventarista(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar($this -> InventaristaDAO -> actualizarInventarista());
        $res = $this -> Conexion -> filasAfectadas();
        $this -> Conexion -> cerrar();
        return $res;
    }

    public function existeCorreo(){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> InventaristaDAO -> existeCorreo());
        $this -> Conexion -> cerrar();
        return $this -> Conexion -> numFilas();
    }

    public function existeNuevoCorreo($correo){
        $this -> Conexion -> abrir();
        $this -> Conexion -> ejecutar( $this -> InventaristaDAO -> existeNuevoCorreo($correo));
        $this -> Conexion -> cerrar();
        return $this -> Conexion -> numFilas();
    }
}
