<?php 


    $str = $_GET['search'];

    $pagina = $_GET['page'];
    $cantPag = $_GET['cantPag'];

    $producto = new Producto();
    if($str != "0"){
        $data = $producto -> filtroPaginado($str, $pagina, $cantPag);
        $resultado = $producto -> filtroCantidad($str);
    }else{
        $data = $producto -> buscarAPaginado($pagina, $cantPag);
        $resultado = $producto -> buscarCantidad();
    }
    
    $cant = $resultado/$cantPag;

    $ajax = Array(
        "DataT" => $data,
        "DataL" => base64_encode("Vista/Producto/actualizarProducto.php"),
        "Cpage" => $pagina,
        "DataP" => $cant
    );
    echo json_encode($ajax);
?>