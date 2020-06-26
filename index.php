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
    
    $pid = null;

    if(isset($_GET['cerrarSesion'])){
        session_destroy();
        $_SESSION = [];
    }
    if(isset($_GET['pid'])){
        $pid = base64_decode($_GET['pid']);
    }

    include "Vista/Main/head.php";
    
    $enter = Array('Vista/Auth/autenticar.php');

    if(isset($pid)){

        if(isset($_SESSION['id'])){
            if($_SESSION['rol'] == 1){
                include "Vista/Administrador/navAdministrador.php";
                include $pid;
            }else if($_SESSION['rol'] == 2){
                include "Vista/Cliente/navCliente.php";
                include $pid;
                include "Vista/Cliente/footerCliente.php";
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