<?php 
    /*
     * Obtener variables
     */
    $str = $_GET['search'];
    $pagina = $_GET['page'];
    $cantPag = $_GET['cantPag'];

    /*
     * Crear el objeto y realizar la consulta
     */
    $Proveedor = new Proveedor();
    $data = $Proveedor -> filtroPaginado($str, $pagina, $cantPag);
    $resultado = $Proveedor -> filtroCantidad($str);
    
    $cant = $resultado/$cantPag;


    /*
     * Crear la estructura de retorno
     */
    $ajax = Array(
        "DataT" => $data,
        "DataL" => base64_encode("Vista/Proveedor/actualizarProveedor.php"),
        "Cpage" => $pagina,
        "DataP" => $cant
    );

    /*
     * Convertir a JSON e imprimir
     */
    echo json_encode($ajax);
?>