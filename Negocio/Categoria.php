<?php

    require_once "Persistencia/CategoriaDAO.php";
    require_once "Persistencia/Conexion.php";

    class Categoria{
        private $idCategoria;
        private $nombre;
        private $Conexion;
        private $categoriaDAO;

        public function Categoria($idCategoria = "", $nombre =""){
            $this -> idCategoria = $idCategoria;
            $this -> nombre = $nombre;
            $this -> Conexion = new Conexion();
            $this -> categoriaDAO = new CategoriaDAO($this -> idCategoria, $this -> nombre);
        }

        /*
         * SETS
         */

        public function setIdCategoria($idCategoria){
            $this -> idCategoria = $idCategoria;
        }
        public function setNombre($nombre){
            $this -> nombre = $nombre;
        }

        /*GETS*/

        public function getIdCategoria(){
            return $this -> idCategoria;
        }
        public function getNombre(){
            return $this -> nombre;
        }

        /*Methods*/

        public function insertar(){
            $this -> Conexion -> abrir();
            $this -> Conexion -> ejecutar( $this -> categoriaDAO -> insertar());
            $rows = $this -> Conexion -> filasAfectadas();
            $this -> Conexion -> cerrar();
            return $rows;
        }

        public function buscarxID(){
            $this -> Conexion -> abrir();
            $this -> Conexion -> ejecutar( $this -> categoriaDAO -> buscarxID());
            $res = $this -> Conexion -> extraer();
            $this -> nombre = $res[1];
            $this -> Conexion -> cerrar();
        }

        public function buscarTodo(){
            $this -> Conexion -> abrir();
            $this -> Conexion -> ejecutar($this -> categoriaDAO -> buscarTodo());

            $resList = Array();

            while($res = $this -> Conexion -> extraer()){
                array_push($resList, new Categoria($res[0], $res[1]));
            }
            $this -> Conexion -> cerrar();

            return $resList;
        }

        public function buscarPaginado(){
            $this -> Conexion -> abrir();
            $this -> Conexion -> ejecutar();
            $this -> Conexion -> cerrar();
        }

        public function filtro($str){
            $this -> Conexion -> abrir();
            $this -> Conexion -> ejecutar( $this -> categoriaDAO -> filtro($str));
            $resList = Array();

            while($res = $this -> Conexion -> extraer()){
                array_push($resList, new Categoria($res[0], $res[1]));
            }
            $this -> Conexion -> cerrar();

            return $resList;
        }

        public function filtroPaginado($str, $pag, $cant){
            $this -> Conexion -> abrir();
            $this -> Conexion -> ejecutar( $this -> categoriaDAO -> filtroPaginado($str, $pag, $cant));
            $resList = Array();

            while($res = $this -> Conexion -> extraer()){
                array_push($resList, $res);
            }
            $this -> Conexion -> cerrar();

            return $resList;
        }

        public function filtroCantidad($str){
            $this -> Conexion -> abrir();
            $this -> Conexion -> ejecutar( $this -> categoriaDAO -> filtroCantidad($str));
            $res = $this -> Conexion -> extraer();
            $this -> Conexion -> cerrar();

            return $res[0];
        }

        public function actualizarCategoria(){
            $this -> Conexion -> abrir();
            $this -> Conexion -> ejecutar($this -> categoriaDAO -> actualizarCategoria());
            $res = $this -> Conexion -> filasAfectadas();
            $this -> Conexion -> cerrar();
            return $res;
        }

    }
?>