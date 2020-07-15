<?php 

class LogDAO{

    private $idLog;
    private $fecha;
    private $informacion;
    private $accion;
    private $browser;
    private $os;
    private $user;

    public function LogDAO($idLog = "", $fecha = "", $informacion = "", $accion = "", $browser = "", $os = "", $user = ""){
        $this -> idLog = $idLog;
        $this -> fecha = $fecha;
        $this -> informacion = $informacion;
        $this -> accion = $accion;
        $this -> browser = $browser;
        $this -> os = $os;
        $this -> user = $user;
    }

    public function buscarPaginado($pagina, $numReg){
        return "SELECT idLogAdministrador, Fecha, informacion, FK_idAccion, accion.nombre AS accion, browser, os, concat(Administrador.nombre, ' ',Administrador.apellido), 1 
                FROM logAdministrador 
                INNER JOIN accion ON FK_idAccion = idAccion 
                INNER JOIN Administrador ON FK_idAdministrador = idAdministrador 
                UNION ALL 
                SELECT idLogCliente, Fecha, informacion, FK_idAccion, accion.nombre AS accion, browser, os, concat(Cliente.nombre, ' ', Cliente.apellido), 2 
                FROM logCliente 
                INNER JOIN accion ON FK_idAccion = idAccion
                INNER JOIN Cliente ON FK_idCliente = idCliente
                UNION ALL
                SELECT idLogInventarista, Fecha, informacion, FK_idAccion,  accion.nombre AS accion, browser, os, concat(Inventarista.nombre, ' ',Inventarista.apellido), 3 
                FROM logInventarista 
                INNER JOIN accion ON FK_idAccion = idAccion
                INNER JOIN Inventarista ON FK_idInventarista = idInventarista
                ORDER BY fecha desc
                LIMIT " . (($pagina - 1)*$numReg) . ", " . $numReg;
    }

    public function buscarCantidad(){
        return "SELECT count(*)
                FROM (
                    SELECT idLogAdministrador
                    FROM logAdministrador
                    UNION ALL 
                    SELECT idLogCliente
                    FROM logCliente 
                    UNION ALL
                    SELECT idLogInventarista
                    FROM logInventarista 
                ) as TL";
    }

    public function filtroPaginado($str, $pag, $cant){
        return "SELECT idLogAdministrador, Fecha, informacion, FK_idAccion, accion.nombre AS accion, browser, os, concat(Administrador.nombre, ' ',Administrador.apellido), 1 
                FROM logAdministrador 
                INNER JOIN accion ON FK_idAccion = idAccion 
                INNER JOIN Administrador ON FK_idAdministrador = idAdministrador 
                WHERE Accion.nombre like '%". $str ."%' OR concat(Administrador.nombre, ' ',Administrador.apellido) like '%" . $str . "%' OR fecha like '%" . $str . "%'
                UNION ALL 
                SELECT idLogCliente, Fecha, informacion, FK_idAccion, accion.nombre AS accion, browser, os, concat(Cliente.nombre, ' ', Cliente.apellido), 2 
                FROM logCliente 
                INNER JOIN accion ON FK_idAccion = idAccion
                INNER JOIN Cliente ON FK_idCliente = idCliente
                WHERE Accion.nombre like '%". $str ."%' OR concat(Cliente.nombre, ' ',Cliente.apellido) like '%" . $str . "%' OR fecha like '%" . $str . "%'
                UNION ALL
                SELECT idLogInventarista, Fecha, informacion, FK_idAccion,  accion.nombre AS accion, browser, os, concat(Inventarista.nombre, ' ',Inventarista.apellido), 3 
                FROM logInventarista 
                INNER JOIN accion ON FK_idAccion = idAccion
                INNER JOIN Inventarista ON FK_idInventarista = idInventarista
                WHERE Accion.nombre like '%". $str ."%' OR concat(Inventarista.nombre, ' ',Inventarista.apellido) like '%" . $str . "%' OR fecha like '%" . $str . "%'
                ORDER BY fecha desc
                LIMIT " . (($pag - 1)*$cant) . ", " . $cant;
    }

    public function filtroCantidad($str){
        return "SELECT count(*)
            FROM (
                SELECT idLogAdministrador, Fecha, informacion, FK_idAccion, accion.nombre AS accion, browser, os, concat(Administrador.nombre, ' ',Administrador.apellido), 1 
                FROM logAdministrador 
                INNER JOIN accion ON FK_idAccion = idAccion 
                INNER JOIN Administrador ON FK_idAdministrador = idAdministrador 
                WHERE Accion.nombre like '%". $str ."%' OR concat(Administrador.nombre, ' ',Administrador.apellido) like '%" . $str . "%' OR fecha like '%" . $str . "%'
                UNION ALL 
                SELECT idLogCliente, Fecha, informacion, FK_idAccion, accion.nombre AS accion, browser, os, concat(Cliente.nombre, ' ', Cliente.apellido), 2 
                FROM logCliente 
                INNER JOIN accion ON FK_idAccion = idAccion
                INNER JOIN Cliente ON FK_idCliente = idCliente
                WHERE Accion.nombre like '%". $str ."%' OR concat(Cliente.nombre, ' ',Cliente.apellido) like '%" . $str . "%' OR fecha like '%" . $str . "%'
                UNION ALL
                SELECT idLogInventarista, Fecha, informacion, FK_idAccion,  accion.nombre AS accion, browser, os, concat(Inventarista.nombre, ' ',Inventarista.apellido), 3 
                FROM logInventarista 
                INNER JOIN accion ON FK_idAccion = idAccion
                INNER JOIN Inventarista ON FK_idInventarista = idInventarista
                WHERE Accion.nombre like '%". $str ."%' OR concat(Inventarista.nombre, ' ',Inventarista.apellido) like '%" . $str . "%' OR fecha like '%" . $str . "%'
            ) as TL";
    }
}
?>