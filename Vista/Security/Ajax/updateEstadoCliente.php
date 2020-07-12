<?php
$idCliente = $_POST['idCliente'];
$estado = $_POST['estado'];

$cliente = new Cliente($idCliente, "", "", "", "", "", $estado);

$res = $cliente->updateEstado();
$cliente -> getInfoBasic();
$ajax = array();

if ($res == 1) {
    /**
     * Creo un objeto para retornar el dia y la hora
     */
    $date = new DateTime();

    if ($_SESSION['rol'] == 1) {
        /**
         * Creo el objeto de log
         */
        $logAdmin = new LogAdmin("", $date->format('Y-m-d H:i:s'), LogHActualizarEstadoCliente($cliente -> getIdCliente(), $cliente -> getNombre()." ". $cliente -> getApellido(), $cliente -> getEstado()), 14, getBrowser(), getOS(), $_SESSION['id']);
        /**
         * Inserto el registro del log
         */
        $logAdmin->insertar();

        /**
         * Log para el Inventarista
         */
    }

    $ajax['status'] = true;
    $ajax['msj'] = "El estado ha sido actualizado correctamente";
} else {
    $ajax['status'] = false;
    $ajax['msj'] = "Hubo un inconveniente, por favor intente denuevo";
}
echo json_encode($ajax);
