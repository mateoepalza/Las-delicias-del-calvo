<?php 

class AccionDAO{
    private $idAccion;
    private $nombre;

    public function AccionDAO($idAccion, $nombre){
        $this -> idAccion = $idAccion;
        $this -> nombre = $nombre;
    }

}


?>