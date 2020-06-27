<?php 


    $str = $_POST['search'];

    $pagina = $_POST['page'];
    $cantPag = $_POST['cantPag'];

    $producto = new Producto();
    
    $data = $producto -> filtroPaginado($str, $pagina, $cantPag);
    $resultado = $producto -> filtroCantidad($str);
    
    
    $cant = $resultado/$cantPag;

    $ajax = Array(
        "DataT" => $data,
        "DataL" => array(base64_encode("Vista/Producto/actualizarProducto.php"), base64_encode("Vista/IngredienteProducto/adicionarIngrediente.php")),
        "Cpage" => $pagina,
        "DataP" => $cant
    );
    echo json_encode($ajax);
?>