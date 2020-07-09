<?php
//if(!isset($_SESSION['id'])){
session_start();
//}

$email = $_POST['email'];
$pass = $_POST['pass'];

$admin = new Administrador("", "", "", $email, $pass);
$clien = new Cliente("", "", "", $email, $pass);
$invent = new Inventarista("", "", "", $email, $pass);
if ($admin->autenticar()) {
    $_SESSION['id'] = $admin->getIdAdministrador();
    $_SESSION['rol'] = 1;

    /**
     * Creo un objeto para retornar el dia y la hora
     */
    $date = new DateTime();
    /**
     * Creo el objeto de log
     */
    $logAdmin = new LogAdmin("", $date->format('Y-m-d H:i:s'), "", 17, getBrowser(), getOS(), $_SESSION['id']);
    /**
     * Inserto el registro del log
     */
    $logAdmin->insertar();

    header('Location: index.php?pid=' . base64_encode('Vista/Administrador/mainAdministrador.php'));
} else if ($clien->autenticar()) {
    if ($clien->getEstado() == 1) {
        $_SESSION['id'] = $clien->getIdCliente();
        $_SESSION['rol'] = 2;
        $_SESSION['carrito'] = createCarrito();

        /**
         * Creo un objeto para retornar el dia y la hora
         */
        $date = new DateTime();
        /**
         * Creo el objeto de log
         */
        $logCliente = new LogCliente("", $date->format('Y-m-d H:i:s'), "", 17, getBrowser(), getOS(), $_SESSION['id']);
        /**
         * Inserto el registro del log
         */
        $logCliente->insertar();

        header('Location: index.php?pid=' . base64_encode('Vista/Cliente/main.php'));
    } else if ($clien->getEstado() == -1) {
        header('Location: index.php?error=2');
    } else if ($clien->getEstado() == 0) {
        header('Location: index.php?error=3');
    }
} else if ($invent->autenticar()) {

    if ($invent->getEstado() == 1) {
        $_SESSION['id'] = $invent->getIdInventarista();
        $_SESSION['rol'] = 3;

        /**
         * Creo un objeto para retornar el dia y la hora
         */
        $date = new DateTime();
        /**
         * Creo el objeto de log
         */
        $logInventarista = new LogInventarista("", $date->format('Y-m-d H:i:s'), "", 17, getBrowser(), getOS(), $_SESSION['id']);
        /**
         * Inserto el registro del log
         */
        $logInventarista->insertar();

        header('Location: index.php?pid=' . base64_encode("Vista/Inventarista/mainInventarista.php"));
    } else {
        header('Location: index.php?error=3');
    }
} else {
    header('Location: index.php?error=1');
}
