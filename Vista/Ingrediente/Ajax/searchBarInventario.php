<?php 

    $str = $_POST['search'];

    $pagina = $_POST['page'];
    $cantPag = $_POST['cantPag'];

    $ingrediente = new Ingrediente();
    
    $data = $ingrediente -> filtroPaginado($str, $pagina, $cantPag);
    $resultado = $ingrediente -> filtroCantidad($str);
    
    $cant = $resultado/$cantPag;

    $ajax = Array(
        "status" => ((count($data) > 0)? true : false),
        "DataT" => $data,
        "DataL" => base64_encode("Vista/Ingrediente/agregarInventario.php"),
        "Cpage" => $pagina,
        "DataP" => $cant
    );
    echo json_encode($ajax);
?>