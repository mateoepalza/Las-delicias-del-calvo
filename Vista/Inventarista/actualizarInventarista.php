<?php

$idInventarista = $_GET['idInventarista'];

if (isset($_POST['actualizarInventarista'])) {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $clave = $_POST['clave'];
    $estado = $_POST['estado'];

    $inventarista = new Inventarista($idInventarista, $nombre, $apellido, $email, $clave, "", $estado);

    if ($clave != "") {
        $res = $inventarista->actualizarCClave();
    } else {
        $res = $inventarista->actualizar();
    }

    if ($res == 1) {
        $msj = "El inventarista se ha actualizado satisfactoriamente.";
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
    $inventarista = new Inventarista($idInventarista);
    $inventarista->getInfoBasic();
}
?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <h1>Actualizar Inventarista</h1>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-11 col-md-12 col-lg-9 col-xl-8">
            <div class="card">
                <div class="card-header">
                    Actualizar un inventarista
                </div>
                <div class="card-body">
                    <form novalidate class="needs-validation" action="index.php?pid=<?php echo base64_encode("Vista/Inventarista/actualizarInventarista.php") ?>&idInventarista=<?php echo $inventarista->getIdInventarista() ?>" method="POST">
                        <div class="form-group">
                            <label>Nombre Completo</label>
                            <div class="row">
                                <div class="col-6">
                                    <input class="form-control" name="nombre" type="text" value="<?php echo $inventarista->getNombre() ?>" required>
                                    <div class="invalid-feedback">
                                        Por favor ingrese el nombre.
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Enhorabuena!
                                    </div>
                                </div>
                                <div class="col-6">
                                    <input class="form-control" name="apellido" type="text" value="<?php echo $inventarista->getApellido() ?>" required>
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
                                <option value="1" <?php echo ($inventarista->getEstado() == 1) ? "selected" : ""; ?>>Activado</option>
                                <option value="0" <?php echo ($inventarista->getEstado() == 0) ? "selected" : ""; ?>>Bloqueado</option>
                            </select>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" type="email" value="<?php echo $inventarista->getCorreo() ?>" required>
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
                            <button class="btn btn-primary w-100" name="actualizarInventarista" type="submit"> Actualizar </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
