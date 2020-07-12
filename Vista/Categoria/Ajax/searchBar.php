<?php


$str = $_POST['search'];

$pagina = $_POST['page'];
$cantPag = $_POST['cantPag'];

$categoria = new Categoria();

$data = $categoria->filtroPaginado($str, $pagina, $cantPag);
$resultado = $categoria->filtroCantidad($str);

$cant = $resultado / $cantPag;

$ajax = array(
    "status" => ((count($data) > 0) ? true : false),
    "DataT" => $data,
    "DataL" => base64_encode("Vista/Categoria/actualizarCategoria.php"),
    "Cpage" => $pagina,
    "DataP" => $cant
);
echo json_encode($ajax);
?>