<?php 

$idProducto = $_POST['idProducto'];
$idIngrediente = $_POST['idIngrediente'];

$InPro = new IngredienteProducto($idProducto, $idIngrediente);
$res = $InPro -> eliminar();

$json = array(
    "status" => "",
    "msj" => "",
    "data" => array()
);

if($res == 1){
    $json['status'] = true;
    $json['msj'] = "El registro ha sido eliminado satisfactoriamente";
}else{
    $json['status'] = false;
    $json['msj'] = "Ha ocurrido algo inesperado";
}

echo json_encode($json);

?>