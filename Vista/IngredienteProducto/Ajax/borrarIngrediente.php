<?php 

$idProducto = $_POST['idProducto'];
$idIngrediente = $_POST['idIngrediente'];

$InPro = new IngredienteProducto($idProducto, $idIngrediente);
$InPro -> getInfoBasic();
$cantidad = $InPro -> getCantidad();
$res = $InPro -> eliminar();

$json = array(
    "status" => "",
    "msj" => "",
    "data" => array()
);

if($res == 1){

    /**
     * Creo un objeto para retornar el dia y la hora
     */
    $date = new DateTime();
    /**
     * Creo un objeto producto
     */
    $producto = new Producto($idProducto);
    /**
     * Busco el nombre del producto
     */
    $producto->getInfo();
    /**
     * Creo un objeto ingrediente
     */
    $ingrediente = new Ingrediente($idIngrediente);
    /**
     * Busco el nombre del ingrediente
     */
    $ingrediente->getInfoBasic();


    if ($_SESSION['rol'] == 1) {
        /**
         * Creo el objeto de log
         */
        $logAdmin = new LogAdmin("", $date->format('Y-m-d H:i:s'), LogHCrearIngredienteProducto($idProducto, $producto->getNombre(), $idIngrediente, $ingrediente->getNombre(), $cantidad), 20, getBrowser(), getOS(), $_SESSION['id']);
        /**
         * Inserto el registro del log
         */
        $logAdmin->insertar();

        /**
         * Log para el Inventarista
         */
    } else if ($_SESSION['rol'] == 3) {
        /**
         * Creo el objeto de log
         */
        $logInventarista = new LogInventarista("", $date->format('Y-m-d H:i:s'), LogHCrearIngredienteProducto($idProducto, $producto->getNombre(), $idIngrediente, $ingrediente->getNombre(), $cantidad), 20, getBrowser(), getOS(), $_SESSION['id']);
        /**
         * Inserto el registro del log
         */
        $logInventarista->insertar();

        /**
         * Log para el Inventarista
         */
    }

    $json['status'] = true;
    $json['msj'] = "El registro ha sido eliminado satisfactoriamente";
}else{
    $json['status'] = false;
    $json['msj'] = "Ha ocurrido algo inesperado";
}

echo json_encode($json);

?>