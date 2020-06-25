<?php
    $idProducto = $_POST['idProducto'];
    $idIngrediente = $_POST['idIngrediente'];
    $cantidad = $_POST['cantidad'];

    $InPro = new IngredienteProducto($idProducto, $idIngrediente, $cantidad);

    $res = $InPro -> actualizar();

    $json = array(
        "status" => "",
        "msj" => "",
        "data" => array()
    );
    
    if($res == 1 || $res == 0){
        $json['status'] = true;
        $json['msj'] = "El ingrediente ha sido actualizado satisfactoriamente";
    }else{
        $json['status'] = false;
        $json['msj'] = "Ha ocurrido algo inesperado";
    }
    
    echo json_encode($json);

?>