<?php 

    $str = $_POST['search'];

    $pagina = $_POST['page'];
    $cantPag = $_POST['cantPag'];

    $inventarista = new Inventarista();
    
    $data = $inventarista -> filtroPaginado($str, $pagina, $cantPag);
    $resultado = $inventarista -> filtroCantidad($str);
    
    $cant = $resultado/$cantPag;

    $ajax = Array(
        "status" => ((count($data) > 0)? true : false),
        "DataT" => $data,
        "DataL" => base64_encode("Vista/Inventarista/actualizarInventarista.php"),
        "Cpage" => $pagina,
        "DataP" => $cant
    );
    echo json_encode($ajax);
?>