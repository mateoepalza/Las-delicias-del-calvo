<?php

require_once "Negocio/Administrador.php";
require_once "Negocio/Cliente.php";
require_once "Negocio/Categoria.php";
require_once "Negocio/Producto.php";
require_once "Negocio/Proveedor.php";
require_once "Negocio/Ingrediente.php";
require_once "Negocio/IngredienteProducto.php";

if ($_GET['pid']) {
    $pid = base64_decode($_GET['pid']);
    include $pid;
}
