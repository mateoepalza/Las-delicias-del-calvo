<?php

if (isset($_POST['sent'])) {

    $nit = $_POST['nit'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $proveedor = new Proveedor("", $nit, $nombre, $telefono, $direccion);
    $alert = $proveedor->insertar();

    if ($alert == 1) {
        /**
         * Creo un objeto para retornar el dia y la hora
         */
        $date = new DateTime();

        if ($_SESSION['rol'] == 1) {
            /**
             * Creo el objeto de log
             */
            $logAdmin = new LogAdmin("", $date->format('Y-m-d H:i:s'), LogHCrearProveedor($nit, $nombre, $telefono, $direccion), 8, getBrowser(), getOS(), $_SESSION['id']);
            /**
             * Inserto el registro del log
             */
            $logAdmin->insertar();
        } else if ($_SESSION['rol'] == 3) {

            /**
             * Creo el objeto de log
             */
            $LogInventarista = new LogInventarista("", $date->format('Y-m-d H:i:s'), LogHCrearProveedor($nit, $nombre, $telefono, $direccion), 8, getBrowser(), getOS(), $_SESSION['id']);
            /**
             * Inserto el registro del log
             */
            $LogInventarista->insertar();
        }

        $msj = "El proveedor fue almacenado correctamente";
        $class = "alert-success";
    } else {
        $msj = "Ocurrió algo inesperado";
        $class = "alert-danger";
    }

    require "Vista/Main/error.php";
}

?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-11 col-md-12 col-lg-9 col-xl-9 form-bg">
            <div class="card">
                <div class="card-body">
                    <form novalidate class="needs-validation" action="index.php?pid=<?php echo base64_encode("Vista/Proveedor/crearProveedor.php") ?>" method="POST">
                        <div class="form-title">
                            <h1>Ingresar Proveedor</h1>
                        </div>
                        <div class="form-group">
                            <label>NIT</label>
                            <input class="form-control" name="nit" type="number" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el NIT.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>nombre</label>
                            <input class="form-control" name="nombre" type="text" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el nombre.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>telefono</label>
                            <input class="form-control" name="telefono" type="number" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el telefono.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Dirección</label>
                            <input class="form-control" name="direccion" type="text" required>
                            <div class="invalid-feedback">
                                Por favor ingrese la dirección.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary w-100" name="sent" type="submit">Crear proveedor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>