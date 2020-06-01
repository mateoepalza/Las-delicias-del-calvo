<?php

    session_start();
    require "../../Negocio/Administrador.php";

    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $admin = new Administrador("", "", "", $email, $pass);

    if($admin -> autenticar()){
        $_SESSION['id'] = $admin -> getIdAdministrador();
        $_SESSION['rol'] = 1;
        header('Location: ../../index.php?pid='. base64_encode('Vista/Administrador/main.php'));
    }else{
        header('Location: ../../index.php?error=1');
    }

?>