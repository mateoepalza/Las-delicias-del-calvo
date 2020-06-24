<?php 

$idProducto = $_GET['idProducto'];
$amount = $_GET['amount'];
$listCarrito = $_SESSION['carrito'];

for($i = 0; $i < count($_SESSION['carrito']); $i++){
    if($_SESSION['carrito'][$i][0] == $idProducto){
        $_SESSION['carrito'][$i][1] = $amount;
    }
}

$producto = new Producto();
$listaProductos =  $producto->searchCarritoItems($_SESSION['carrito']);
$totalPrice = $producto -> getTotalPrice($listaProductos);

$json = array(
    "status" => true,
    "data" => $totalPrice
);

echo json_encode($json);

?>