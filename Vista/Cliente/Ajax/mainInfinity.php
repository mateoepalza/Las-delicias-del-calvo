<?php 

$inicio = $_POST['inicio'];

$producto = new Producto();

$res = $producto -> getDestProductsAjax($inicio, 10);

$json = array(
    "status" => ((count($res) > 0)? true : false),
    "Data" => $res,
    "DataL" => base64_encode("Vista/Producto/descripProducto.php")
);

echo json_encode($json);

?>