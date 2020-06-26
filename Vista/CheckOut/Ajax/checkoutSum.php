<?php 

$idProducto = $_POST['idProducto'];
$amount = $_POST['amount'];

$producto = new Producto($idProducto);
$bool = $producto -> getStockItemCart($amount);

$json = array(
    "status" => $bool,
    "msj" => "",
    "data" => ""
);


if($bool){

    $carrito = new Carrito($idProducto, $amount);

    $carrito -> actualizarCantidad();
    $listaProductos =  $carrito -> searchCarritoItems();
    $totalPrice = $carrito -> getTotalPriceList($listaProductos);

    $json['msj'] = "La adición ha sido exitosa";
    $json['data'] = array(
        "totalPrice" => $totalPrice
    );

}else{
    $json['msj'] = "El producto está agotado";
    $json['data'] = array();
    $json['data'] = array(
        "totalPrice" => 0
    );

}

echo json_encode($json);

?>