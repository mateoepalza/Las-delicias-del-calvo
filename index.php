<?php

    session_start();
    
    if(isset($_GET['cerrarSesion'])){
        session_destroy();
        $_SESSION = [];
    }

    include "Vista/Main/head.php";

    if(isset($_SESSION['id'])){
        if($_SESSION['rol'] == 1){
            include base64_decode($_GET['pid']);
        }
    }else{
        include "Vista/Main/mainPage.php";
    }
    
    include "Vista/Main/bottom.php";
?>