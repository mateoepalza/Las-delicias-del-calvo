<?php 

    $idProducto = $_POST['idProducto'];
    $cantidad = $_POST['cantidad'];

    $carrito = dSerializeC();
    $bool = $carrito -> getStockAjax($idProducto, $cantidad);



    $json = array(
        "status" => $bool,
        "msj" =>  "",
        "data" => array()
    );

    if($bool){
        $json["msj"] = "El producto puede ser agregado a carrito";
    }else{
        $json["msj"] = "El producto se encuentra agotado";
    }

    echo json_encode($json);

?>