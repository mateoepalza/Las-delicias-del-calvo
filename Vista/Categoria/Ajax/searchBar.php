<?php 


    $str = $_POST['search'];

    $pagina = $_POST['page'];
    $cantPag = $_POST['cantPag'];

    $categoria = new Categoria();

    if($str != "0"){
        $data = $categoria -> filtroPaginado($str, $pagina, $cantPag);
        $resultado = $categoria -> filtroCantidad($str);
    }else{
        $data = $categoria -> buscarAPaginado($pagina, $cantPag);
        $resultado = $categoria -> buscarCantidad($str);
    }
    
    $cant = $resultado/$cantPag;

    $ajax = Array(
        "DataT" => $data,
        "DataL" => base64_encode("Vista/Categoria/actualizarCategoria.php"),
        "Cpage" => $pagina,
        "DataP" => $cant
    );
    echo json_encode($ajax);
?>