<?php 


    $str = $_GET['search'];

    $pagina = $_GET['page'];
    $cantPag = $_GET['cantPag'];

    $cliente = new Cliente();
    if($str != "0"){
        $data = $cliente -> filtroPaginado($str, $pagina, $cantPag);
        $resultado = $cliente -> filtroCantidad($str);
    }else{
        $data = $cliente -> buscarAPaginado($pagina, $cantPag);
        $resultado = $cliente -> buscarCantidad($str);
    }
    
    $cant = $resultado/$cantPag;

    $ajax = Array(
        "DataT" => $data,
        "DataL" => base64_encode("Vista/Producto/.php"),
        "Cpage" => $pagina,
        "DataP" => $cant
    );
    echo json_encode($ajax);
?>