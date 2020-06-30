<?php 

$idProducto = $_POST['idProducto'];

$carrito = dSerializeC();
$res = $carrito -> eliminarCarrito($idProducto);
$totalPrice = $carrito -> getTotalPriceList();
$itemsCarrito = $carrito -> cantidadItems();
serializeC($carrito);
$json = array(
    "status" => $res,
    "msj" => "",
    "data" => array(
            "totalPrice" => number_format($totalPrice, 2, ",", "."),
            "itemsCarrito" => $itemsCarrito
        )
);

if($res){
    $json['msj'] = "El registro ha sido eliminado correctamente";
}else{
    $json["msj"] = "Ocurrió algo inesperado";
}

echo json_encode($json);

?>