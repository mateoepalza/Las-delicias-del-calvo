<?php

if (isset($_POST['cambiarClave'])) {

    $idInventarista = $_SESSION['id'];
    $claveActual = $_POST['claveActual'];
    $nuevaClave = $_POST['nuevaClave'];
    $reNuevaClave = $_POST['reNuevaClave'];

    $class = "alert-danger";

    if ($nuevaClave == $reNuevaClave) {
        $admin = new Administrador($idInventarista, "", "", "", $claveActual);

        if ($admin->checkClave()) {
            $res = $admin->actualizarClave($nuevaClave);

            if ($res == 1 || $res == 0) {

                /**
                 * Creo un objeto para retornar el dia y la hora
                 */
                $date = new DateTime();

                if ($_SESSION['rol'] == 1) {
                    /**
                     * Creo el objeto de log
                     */
                    $logAdmin = new LogAdmin("", $date->format('Y-m-d H:i:s'), "", 21, getBrowser(), getOS(), $_SESSION['id']);
                    /**
                     * Inserto el registro del log
                     */
                    $logAdmin->insertar();

                    /**
                     * Log para el Inventarista
                     */
                }

                $class = "alert-success";
                $msj = "La contraseña ha sido actualizada satisfactoriamente.";
            } else {
                $msj = "Ocurrió algo inesperado.";
            }
        } else {
            $msj = "La contraseña actual no coincide, intente de nuevo.";
        }
    } else {
        $msj = "La contraseña nueva no coincide.";
    }

    include "Vista/Main/error.php";
}

?>
<div class="container  mt-5 mb-5">
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-11 col-md-12 col-lg-9 col-xl-8 form-bg">
            <div class="card">
                <div class="card-body">
                    <form novalidate class="needs-validation" action="index.php?pid=<?php echo base64_encode("Vista/Administrador/cambiarClaveAdministrador.php") ?>" method=POST>
                        <div class="form-title">
                            <h1>Actualizar Contraseña</h1>
                        </div>
                        <div class="form-group">
                            <label>Contraseña Actual</label>
                            <input type="password" name="claveActual" value="" placeholder="Ingrese la contraseña actual" class="form-control" required>
                            <div class="invalid-feedback">
                                Por favor ingrese su contraseña actual.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <label>Nueva contraseña</label>
                            <input type="password" name="nuevaClave" value="" placeholder="Ingrese la nueva contraseña" class="form-control" required>
                            <div class="invalid-feedback">
                                Por favor ingrese su nueva contraseña.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <label>Repita la nueva contraseña</label>
                            <input type="password" name="reNuevaClave" value="" placeholder="Repita la nueva contraseña" class="form-control" required>
                            <div class="invalid-feedback">
                                Por favor repita la nueva contraseña.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <button type="submit" name="cambiarClave" class="btn btn-primary w-100">Cambiar contraseña</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>