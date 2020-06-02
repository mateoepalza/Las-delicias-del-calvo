<?php

    session_start();

    require "Negocio/Administrador.php";
    require "Negocio/Cliente.php";
    
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
                include $pid;
            }else if($_SESSION['rol'] == 2){
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