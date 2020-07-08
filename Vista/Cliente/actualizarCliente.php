<?php

$idCliente = $_GET['idCliente'];

if (isset($_POST['actualizarCliente'])) {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $clave = $_POST['clave'];
    $estado = $_POST['estado'];

    $cliente = new Cliente($idCliente, $nombre, $apellido, $email, $clave, "", $estado);

    if ($clave != "") {
        $res = $cliente->actualizarCClave();
    } else {
        $res = $cliente->actualizar();
    }

    if ($res == 1) {
        $msj = "El cliente se ha actualizado satisfactoriamente.";
        $class = "alert-success";
    } else if ($res == 0) {
        $msj = "No hubo ningún cambio.";
        $class = "alert-warning";
    } else {
        $msj = "Ocurrió algo inesperado, intente de nuevo.";
        $class = "alert-danger";
    }

    include "Vista/Main/error.php";
} else {
    $cliente = new Cliente($idCliente);
    $cliente -> getInfoBasic();
}
?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <h1>Actualizar Cliente</h1>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-11 col-md-12 col-lg-9 col-xl-8">
            <div class="card">
                <div class="card-header">
                    Actualizar un cliente
                </div>
                <div class="card-body">
                    <form novalidate class="needs-validation" action="index.php?pid=<?php echo base64_encode("Vista/Cliente/actualizarCliente.php") ?>&idCliente=<?php echo $cliente->getIdCliente() ?>" method="POST">
                        <div class="form-group">
                            <label>Nombre Completo</label>
                            <div class="row">
                                <div class="col-6">
                                    <input class="form-control" name="nombre" type="text" value="<?php echo $cliente->getNombre() ?>" placeholder="Ingrese su nombre" required>
                                    <div class="invalid-feedback">
                                        Por favor ingrese el nombre.
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Enhorabuena!
                                    </div>
                                </div>
                                <div class="col-6">
                                    <input class="form-control" name="apellido" type="text" value="<?php echo $cliente->getApellido() ?>" placeholder="Ingrese su apellido" required>
                                    <div class="invalid-feedback">
                                        Por favor ingrese el apellido.
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Enhorabuena!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Estado</label>
                            <select name="estado" class="form-control" required>
                                <option value="1" <?php echo ($cliente->getEstado() == 1) ? "selected" : ""; ?>>Activado</option>
                                <option value="0" <?php echo ($cliente->getEstado() == 0) ? "selected" : ""; ?>>Bloqueado</option>
                                <option value="-1" <?php echo ($cliente->getEstado() == -1) ? "selected" : ""; ?>>Desactivado</option>
                            </select>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" type="email" value="<?php echo $cliente->getCorreo() ?>"  placeholder="Ingrese su correo" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el correo.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input class="form-control" name="clave" type="password" value="">
                        </div>
                        <div>
                            <button class="btn btn-primary w-100" name="actualizarCliente" type="submit">Actualizar cliente </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
