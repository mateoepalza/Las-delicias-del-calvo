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
    require_once "Negocio/Factura.php";
    require_once "Negocio/FacturaProducto.php";
    require_once "Negocio/Inventarista.php";
    require_once "Negocio/Correo.php";
    require_once "Negocio/LogAdmin.php";
    require_once "Negocio/LogInventarista.php";
    require_once "Negocio/LogCliente.php";
    require_once "Negocio/Accion.php";
    //Check
    require_once "Helpers/logHelper.php";
    require_once "Helpers/serialize.php";
    
    $pid = null;

    if(isset($_GET['cerrarSesion'])){
        session_destroy();
        $_SESSION = [];
    }
    if(isset($_GET['pid'])){
        $pid = base64_decode($_GET['pid']);
    }

    include "Vista/Main/head.php";
    
    $enter = Array('Vista/Auth/autenticar.php', 'Vista/Auth/clienteActivarCuenta.php');

    if(isset($pid)){

        if(isset($_SESSION['id'])){
            if($_SESSION['rol'] == 1){
                include "Vista/Administrador/navAdministrador.php";
                include $pid;
            }else if($_SESSION['rol'] == 2){
                include "Vista/Cliente/navCliente.php";
                include $pid;
                include "Vista/Cliente/footerCliente.php";
            }else if($_SESSION['rol'] == 3){
                include "Vista/Inventarista/navInventarista.php";
                include $pid;
            }else{
                include "Vista/Main/mainPage.php";/*Toca cambiarlo*/
            }
        }else if(in_array($pid, $enter)){
            echo "Acaaa";
            include $pid;
        }else{
            header("Location: index.php");
        }

    }else{
        include "Vista/Main/mainPage.php";
    }
    
    include "Vista/Main/bottom.php";
?>