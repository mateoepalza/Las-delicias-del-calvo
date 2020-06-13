<?php

    session_start();

    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $admin = new Administrador("", "", "", $email, $pass);
    $clien = new Cliente("","","", $email, $pass);
    if($admin -> autenticar()){
        $_SESSION['id'] = $admin -> getIdAdministrador();
        $_SESSION['rol'] = 1;
        header('Location: index.php?pid='. base64_encode('Vista/Administrador/mainAdministrador.php'));
    }else if($clien -> autenticar()){
        if($clien -> getEstado() == 1){
            $_SESSION['id'] = $clien -> getIdCliente();
            $_SESSION['rol'] = 2;
            echo "Entraaa";
            header('Location: index.php?pid='. base64_encode('Vista/Cliente/main.php'));
        }else if($clien -> getEstado() == -1){
            header('Location: index.php?error=2');
        }else if($clien -> getEstado() == 0){
            header('Location: index.php?error=3');
        }
        
    }else{
        header('Location: index.php?error=1');
    }

?>