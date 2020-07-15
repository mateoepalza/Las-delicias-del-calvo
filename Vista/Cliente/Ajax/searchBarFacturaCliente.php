<?php 
    $str = $_POST['search'];

    $pagina = $_POST['page'];
    $cantPag = $_POST['cantPag'];

    $factura = new Factura( "", "", "", $_SESSION['id']);
    
    
        $data = $factura -> filtroPaginadoCliente($str, $pagina, $cantPag);
        $resultado = $factura -> filtroCantidadCliente($str);
    

    
    
    $cant = $resultado/$cantPag;

    $ajax = Array(
        "status" => ((count($data) > 0)? true : false),
        "DataT" => $data,
        "DataL" => base64_encode("Vista/Factura/Ajax/modalInfo.php"),
        "Cpage" => $pagina,
        "DataP" => $cant
    );
    echo json_encode($ajax);
?>