<?php 

    $str = $_GET['search'];

    $pagina = $_GET['page'];
    $cantPag = $_GET['cantPag'];

    $ingrediente = new Ingrediente();
    
    $data = $ingrediente -> filtroPaginado($str, $pagina, $cantPag);
    $resultado = $ingrediente -> filtroCantidad($str);
    
    $cant = $resultado/$cantPag;

    $ajax = Array(
        "DataT" => $data,
        "DataL" => base64_encode("Vista/Ingrediente/actualizarIngrediente.php"),
        "Cpage" => $pagina,
        "DataP" => $cant
    );
    echo json_encode($ajax);
?>