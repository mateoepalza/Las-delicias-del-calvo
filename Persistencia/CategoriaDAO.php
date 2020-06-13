<?php

    class CategoriaDAO{
        private $idCategoria;
        private $nombre;

        public function CategoriaDAO($idCategoria = "", $nombre =""){
            $this -> idCategoria = $idCategoria;
            $this -> nombre = $nombre;
        }

        /*Methods*/

        public function insertar(){
            return "INSERT INTO Categoria (nombre)
                    VALUES ('" . $this -> nombre . "')";
        }

        public function buscarxID(){
            return "SELECT idCategoria, nombre 
                    FROM Categoria
                    WHERE idCategoria = ".$this -> idCategoria;
        }

        public function buscarTodo(){
            return "SELECT idCategoria, nombre 
                    FROM Categoria";
        }

        public function filtro($str){
            return "SELECT idCategoria, nombre 
                    FROM Categoria
                    WHERE nombre like '%" . $str . "%'";
        }

        public function filtroPaginado($str, $pag, $cant){
            return "SELECT idCategoria, nombre 
                    FROM Categoria
                    WHERE nombre like '%" . $str . "%'
                    LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
        }

        public function filtroCantidad($str){
            return "SELECT count(*) 
                    FROM Categoria
                    WHERE nombre like '%" . $str . "%'";
        }

        public function actualizarCategoria(){
            return "UPDATE Categoria
                    SET nombre = '" . $this -> nombre . "'
                    WHERE idCategoria = ". $this -> idCategoria;
        }
    }
?>