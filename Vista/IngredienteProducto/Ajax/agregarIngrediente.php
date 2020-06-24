<?php 

$idProducto = $_POST['idProducto'];
$idIngrediente = $_POST['idIngrediente'];
$cantidad = $_POST['cantidad'];

$InPro = new IngredienteProducto($idProducto, $idIngrediente, $cantidad);
$res = $InPro -> agregar();

$json = array(
    "status" => "",
    "msj" => "",
    "data" => array()
);

if($res == 1){
    $resData = $InPro -> buscarIngrediente();
    $json['status'] = true;
    $json['msj'] = "El ingrediente ha sido agregado satisfactoriamente";
    $json['data'] = $resData;
}else{
    $json['status'] = false;
    $json['msj'] = "Ha ocurrido algo inesperado";
}

echo json_encode($json);

?>