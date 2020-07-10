<?php
session_start();
require_once "Negocio/Administrador.php";
require_once "Negocio/Cliente.php";
require_once "Negocio/Categoria.php";
require_once "Negocio/Producto.php";
require_once "Negocio/Proveedor.php";
require_once "Negocio/Ingrediente.php";
require_once "Negocio/IngredienteProducto.php";
require_once "Negocio/Carrito.php";
require_once "Negocio/Inventarista.php";
require_once "Negocio/Factura.php";
require_once "Negocio/FacturaProducto.php";
require_once "Negocio/Log.php";
require_once "Negocio/LogAdmin.php";
require_once "Negocio/LogInventarista.php";
//Check
require_once "Helpers/logHelper.php";

if ($_GET['pid']) {
    $pid = base64_decode($_GET['pid']);
    include $pid;
}
