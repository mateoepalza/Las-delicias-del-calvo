<?php 

    $str = $_POST['search'];

    $pagina = $_POST['page'];
    $cantPag = $_POST['cantPag'];

    $admin = new Administrador();
    
    $data = $admin -> filtroPaginado($str, $pagina, $cantPag);
    $resultado = $admin -> filtroCantidad($str);
    
    $cant = $resultado/$cantPag;

    $ajax = Array(
        "status" => ((count($data) > 0)? true : false),
        "DataT" => $data,
        "DataL" => "",
        "Cpage" => $pagina,
        "DataP" => $cant
    );
    echo json_encode($ajax);
?>