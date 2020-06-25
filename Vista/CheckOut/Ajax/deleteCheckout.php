<?php 

$idProducto = $_POST['idProducto'];

$carrito = new Carrito($idProducto);

$res = $carrito -> eliminarCarrito();
$listaProductos =  $carrito -> searchCarritoItems();
$totalPrice = $carrito -> getTotalPriceList($listaProductos);
$itemsCarrito = $carrito -> totalItemsCarrito();

$json = array(
    "status" => $res,
    "msj" => "",
    "data" => array(
            "totalPrice" => $totalPrice,
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