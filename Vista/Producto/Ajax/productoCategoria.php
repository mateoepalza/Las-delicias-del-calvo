<?php


$str = $_POST['search'];
$category = $_POST['category'];
$pagina = $_POST['page'];
$cantPag = 5;

$producto = new Producto();

$data = $producto->filtroPaginadoByCategoria($category, $str, $pagina, $cantPag);
$resultado = $producto->filtroCantidadByCategoria($category, $str);

$cant = $resultado / $cantPag;

$ajax = array(
    "status" => ((count($data) > 0) ? true : false),
    "DataT" => $data,
    "DataL" => base64_encode("Vista/Producto/descripProducto.php"),
    "Cpage" => $pagina,
    "DataP" => $cant
);
echo json_encode($ajax);
?>