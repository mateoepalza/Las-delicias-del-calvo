<?php 

$idProducto = $_POST['idProducto'];
$amount = $_POST['amount'];

$carrito = dSerializeC();
$bool = $carrito -> getStockAjax($idProducto, $amount);

$json = array(
    "status" => $bool,
    "msj" => "",
    "data" => ""
);


if($bool){
    $carrito -> actualizarCantidadProducto($idProducto, $amount);
    $totalPrice = $carrito -> getTotalPriceList();

    $json['msj'] = "La adición ha sido exitosa";
    $json['data'] = array(
        "totalPrice" => $totalPrice
    );

}else{
    $json['msj'] = "El producto está agotado";
    $json['data'] = array(
        "totalPrice" => 0
    );

}

serializeC($carrito);   

echo json_encode($json);

?>