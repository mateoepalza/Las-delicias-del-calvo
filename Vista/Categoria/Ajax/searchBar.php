<?php 
    $str = $_GET['search'];

    $pagina = 1;
    $cantPag = 5;

    $categoria = new Categoria();
    $data = $categoria -> filtroPaginado($str, $pagina, $cantPag);
    $resultado = $categoria -> filtroCantidad($str);

    $cant = $resultado/$cantPag;

    $ajax = Array(
        "DataT" => $data,
        "DataL" => base64_encode("Vista/Categoria/actualizarCategoria.php"),
        "Cpage" => $pagina,
        "DataP" => $cant
    );
    echo json_encode($ajax);
?>