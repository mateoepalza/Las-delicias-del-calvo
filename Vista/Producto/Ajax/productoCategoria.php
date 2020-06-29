<?php 


    $str = $_POST['search'];
    $category = $_POST['category'];
    $pagina = $_POST['page'];
    $cantPag = 5;

    $producto = new Producto();
    
    if($str != "0"){
        $data = $producto -> filtroPaginadoByCategoria($category, $str, $pagina, $cantPag);
        $resultado = $producto -> filtroCantidadByCategoria($category, $str);
    }else{
        $data = $producto -> buscarAPaginadoByCategory($category, $pagina, $cantPag);
        $resultado = $producto -> buscarCantidadByCategory($category);
    }
    
    $cant = $resultado/$cantPag;

    $ajax = Array(
        "DataT" => $data,
        "DataL" => base64_encode("Vista/Producto/descripProducto.php"),
        "Cpage" => $pagina,
        "DataP" => $cant
    );
    echo json_encode($ajax);
?>