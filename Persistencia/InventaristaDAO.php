<?php 

    require_once "Persistencia/Conexion.php";
    require_once "Persistencia/InventaristaDAO.php";

    class InventaristaDAO{

        private $idInventarista;
        private $nombre;
        private $apellido;
        private $correo;
        private $clave;
        private $foto;
        private $estado;
        
        private $InventaristaDAO;
        private $Conexion;
    
        public function InventaristaDAO($idInventarista = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $foto = "", $estado = ""){
            $this -> idInventarista = $idInventarista;
            $this -> nombre = $nombre;
            $this -> apellido = $apellido;
            $this -> correo = $correo;
            $this -> clave = $clave;
            $this -> foto = $foto;
            $this -> estado = $estado;
        }

        /*Methods*/

        public function autenticar(){
            return "SELECT idInventarista, nombre, apellido, foto, estado
                    FROM Inventarista
                    Where email = '" . $this -> correo . "' AND clave = '" . md5($this -> clave) . "'";
        }

        public function getInfoBasic(){
            return "SELECT idInventarista, nombre, apellido, email, clave, foto, estado 
                    FROM Inventarista 
                    WHERE idInventarista = ". $this -> idInventarista;
        }

        public function buscarPaginado($pag, $cant){
            return "SELECT idInventarista, nombre, apellido, email, clave, foto, estado 
                    FROM Inventarista
                    LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
        }

        public function buscarCantidad(){
            return "SELECT count(*) 
                    FROM Inventarista";
        }

        public function filtroPaginado($str, $pag, $cant){
            return "SELECT idInventarista, nombre, apellido, email, estado 
                    FROM Inventarista 
                    WHERE Inventarista.nombre like '%". $str ."%' OR Inventarista.apellido like '%" . $str . "%' OR Inventarista.email like '%" . $str . "%'
                    LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
        }

        public function filtroCantidad($str){
            return "SELECT count(*) 
                    FROM Inventarista
                    WHERE Inventarista.nombre like '%". $str ."%' OR Inventarista.apellido like '%" . $str . "%' OR Inventarista.email like '%" . $str . "%'";
        }

        public function updateEstado(){
            return "UPDATE Inventarista
                    SET
                        estado = ". $this -> estado . "
                    WHERE idInventarista = " . $this -> idInventarista;
        }

        public function actualizar(){
            return "UPDATE Inventarista
                    SET
                        nombre = '" . $this -> nombre . "',
                        apellido = '" . $this -> apellido . "',
                        email = '" . $this -> correo . "',
                        estado = '" . $this -> estado . "'
                    WHERE idInventarista = ". $this -> idInventarista;
        }

        public function actualizarCClave(){
            return "UPDATE Inventarista
                    SET
                        nombre = '" . $this -> nombre . "',
                        apellido = '" . $this -> apellido . "',
                        email = '" . $this -> correo . "',
                        estado = '" . $this -> estado . "',
                        clave = '" . md5($this -> clave) . "'
                    WHERE idInventarista = ". $this -> idInventarista;
        }

        public function insertar(){
            return "INSERT INTO Inventarista (nombre, apellido, email, clave, foto, estado) 
                    VALUES ('" . $this -> nombre ."', '" . $this -> apellido  ."', '" . $this -> correo  ."', '" . md5($this -> clave)  ."', '" . $this -> foto . "','" . $this -> estado  ."')";
        }

        public function checkClave(){
            return "SELECT idInventarista
                    FROM Inventarista
                    WHERE idInventarista = '" . $this -> idInventarista . "' AND clave = '" . md5($this -> clave) . "'";
        }

        public function actualizarClave($nuevaClave){
            return "UPDATE Inventarista
                    SET
                        clave = '" . md5($nuevaClave) . "'
                    WHERE idInventarista = " . $this -> idInventarista;
        }

        public function actualizarInventarista(){
            return "UPDATE Inventarista
                    SET
                        nombre = '" . $this -> nombre . "',
                        apellido = '" . $this -> apellido . "',
                        email = '" . $this -> correo . "',
                        foto = '" . $this -> foto . "'
                    WHERE idInventarista = ". $this -> idInventarista;
        }

        public function existeCorreo(){
            return "SELECT idInventarista
                    FROM Inventarista
                    WHERE email = '" . $this -> correo . "'";
        }

        public function existeNuevoCorreo($correo){
            return "SELECT idInventarista
                    FROM Inventarista
                    WHERE email = '" . $correo . "'";
        }

    }
?>