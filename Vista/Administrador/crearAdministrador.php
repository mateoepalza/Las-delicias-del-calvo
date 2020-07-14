<?php

if (isset($_POST['crearAdministrador'])) {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $clave = $_POST['clave'];


    $Administrador = new Administrador("", $nombre, $apellido, $email, $clave);
    $inventarista = new Inventarista("", "", "", $email);
    $Cliente = new Cliente("", "", "", $email);

    if ($Cliente->existeCorreo() || $inventarista->existeCorreo() || $Administrador->existeCorreo()) {

        $msj = "El correo proporcionado ya se encuentra en uso.";
        $class = "alert-danger";
    } else {
        $res = $Administrador->insertar();

        if ($res == 1) {

            if ($_SESSION['rol'] == 1) {
                /**
                 * Creo un objeto para retornar el dia y la hora
                 */
                $date = new DateTime();
                /**
                 * Creo el objeto de log
                 */
                $logAdmin = new LogAdmin("", $date->format('Y-m-d H:i:s'), LogHCrearAdministrador($nombre, $apellido, $email, $clave), 24, getBrowser(), getOS(), $_SESSION['id']);
                /**
                 * Inserto el registro del log
                 */
                $logAdmin->insertar();
            }

            $msj = "El administrador se ha creado satisfactoriamente";
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
                    <div class="form-title">
                        <h1>Crear Administrador</h1>
                    </div>
                    <form novalidate class="needs-validation" action="index.php?pid=<?php echo base64_encode("Vista/Administrador/crearAdministrador.php") ?>" method="POST">
                        <div class="form-group">
                            <label>Nombre Completo</label>
                            <div class="row">
                                <div class="col-6">
                                    <input class="form-control" name="nombre" type="text" placeholder="Ingrese el nombre" required>
                                    <div class="invalid-feedback">
                                        Por favor ingrese el nombre.
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Enhorabuena!
                                    </div>
                                </div>
                                <div class="col-6">
                                    <input class="form-control" name="apellido" type="text" placeholder="Ingrese el apellido" required>
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
                            <label>Email</label>
                            <input class="form-control" name="email" type="email" placeholder="Ingrese el correo" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el correo.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input class="form-control" name="clave" type="password" value="" placeholder="Ingrese la contraseña" required>
                            <div class="invalid-feedback">
                                Por favor ingrese la contraseña.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary w-100" name="crearAdministrador" type="submit"> Crear administrador </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>