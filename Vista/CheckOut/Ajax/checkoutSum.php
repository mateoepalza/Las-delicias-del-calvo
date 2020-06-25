<?php 

$idProducto = $_POST['idProducto'];
$amount = $_POST['amount'];

$carrito = new Carrito($idProducto, $amount);

$carrito -> actualizarCantidad();
$listaProductos =  $carrito -> searchCarritoItems();
$totalPrice = $carrito -> getTotalPriceList($listaProductos);

$json = array(
    "status" => true,
    "data" => $totalPrice
);

echo json_encode($json);

?>