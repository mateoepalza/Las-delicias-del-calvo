<?php

if (isset($_POST['crearInventarista'])) {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $clave = $_POST['clave'];
    $estado = $_POST['estado'];

    $inventarista = new Inventarista("", $nombre, $apellido, $email, $clave, "", $estado);
    $cliente = new Cliente("", "", "", $email);
    $administrador = new Administrador("", "", "", $email);

    if ($inventarista->existeCorreo() || $cliente->existeCorreo() || $administrador->existeCorreo()) {

        $msj = "El correo suministrado ya se encuentra en uso";
        $class = "alert-danger";
    } else {

        $res = $inventarista->insertar();

        if ($res == 1) {

            if ($_SESSION['rol'] == 1) {
                /**
                 * Creo un objeto para retornar el dia y la hora
                 */
                $date = new DateTime();
                /**
                 * Creo el objeto de log
                 */
                $logAdmin = new LogAdmin("", $date->format('Y-m-d H:i:s'), LogHCrearInventarista($nombre, $apellido, $email, $clave, $estado), 12, getBrowser(), getOS(), $_SESSION['id']);
                /**
                 * Inserto el registro del log
                 */
                $logAdmin->insertar();
            }

            $msj = "El inventarista se ha creado satisfactoriamente";
            $class = "alert-success";
        } else {
            $msj = "Ocurrió algo inesperado, intente de nuevo.";
            $class = "alert-danger";
        }
    }


    include "Vista/Main/error.php";
}
?>
<div class="container mt-5 mb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-11 col-md-12 col-lg-9 col-xl-8 form-bg">
            <div class="card">
                <div class="card-body">
                    <form novalidate class="needs-validation" action="index.php?pid=<?php echo base64_encode("Vista/Inventarista/crearInventarista.php") ?>" method="POST">
                        <div class="form-title">
                            <h1>Crear Inventarista</h1>
                        </div>
                        <div class="form-group">
                            <label>Nombre Completo</label>
                            <div class="row">
                                <div class="col-6">
                                    <input class="form-control" name="nombre" type="text" required>
                                    <div class="invalid-feedback">
                                        Por favor ingrese el nombre.
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Enhorabuena!
                                    </div>
                                </div>
                                <div class="col-6">
                                    <input class="form-control" name="apellido" type="text" required>
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
                                <option value="" selected disabled>-- Estado --</option>
                                <option value="1">Activado</option>
                                <option value="0">Bloqueado</option>
                            </select>
                            <div class="invalid-feedback">
                                Por favor seleccione un estado.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" type="email" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el correo.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input class="form-control" name="clave" type="password" value="" required>
                            <div class="invalid-feedback">
                                Por favor ingrese la contraseña.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary w-100" name="crearInventarista" type="submit"> Crear </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>