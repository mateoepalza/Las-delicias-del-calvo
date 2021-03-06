<?php

$idProveedor = $_GET['idProveedor'];

if (isset($_POST['actualizarProveedor'])) {

    $nit = $_POST['nit'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $Proveedor = new Proveedor($idProveedor, $nit, $nombre, $telefono, $direccion);

    $alert = $Proveedor->actualizarProveedor();

    if ($alert == 1) {

        /**
         * Creo un objeto para retornar el dia y la hora
         */
        $date = new DateTime();

        if ($_SESSION['rol'] == 1) {
            /**
             * Creo el objeto de log
             */
            $logAdmin = new LogAdmin("", $date->format('Y-m-d H:i:s'), LogHActualizarProveedor($idProveedor, $nit, $nombre, $telefono, $direccion), 9, getBrowser(), getOS(), $_SESSION['id']);
            /**
             * Inserto el registro del log
             */
            $logAdmin->insertar();
        } else if ($_SESSION['rol'] == 3) {

            /**
             * Creo el objeto de log
             */
            $LogInventarista = new LogInventarista("", $date->format('Y-m-d H:i:s'), LogHActualizarProveedor($idProveedor, $nit, $nombre, $telefono, $direccion), 9, getBrowser(), getOS(), $_SESSION['id']);
            /**
             * Inserto el registro del log
             */
            $LogInventarista->insertar();
        }

        $msj = "El proveedor ha sido actualizado satisfactoriamente";
        $class = "alert-success";
    } else if ($alert == 0) {
        $msj = "No hubo ningún cambio.";
        $class = "alert-warning";
    } else {
        $msj = "Ha ocurrido algo inesperado";
        $class = "alert-danger";
    }

    include "Vista/Main/error.php";
} else {
    $Proveedor = new Proveedor($idProveedor);
    $Proveedor->getInfo();
}

?>

<div class="container mt-5 mb-5">

    <div class="row justify-content-center mt-5">
        <div class="col-11 col-md-12 col-lg-9 col-xl-8 form-bg">
            <div class="card">
                <div class="card-body">
                    <form novalidate class="needs-validation" action="index.php?pid=<?php echo base64_encode("Vista/Proveedor/actualizarProveedor.php") ?>&idProveedor=<?php echo $idProveedor ?>" method="POST">
                        <div class="form-title">
                            <h1>Actualizar Proveedor</h1>
                        </div>
                        <div class="form-group">
                            <label>NIT</label>
                            <input class="form-control" name="nit" type="number" value="<?php echo $Proveedor->getNit() ?>" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el NIT.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>nombre</label>
                            <input class="form-control" name="nombre" type="text" value="<?php echo $Proveedor->getNombre() ?>" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el nombre.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>teléfono</label>
                            <input class="form-control" name="telefono" type="number" value="<?php echo $Proveedor->getTelefono() ?>" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el teléfono.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Dirección</label>
                            <input class="form-control" name="direccion" type="text" value="<?php echo $Proveedor->getDireccion() ?>" required>
                            <div class="invalid-feedback">
                                Por favor ingrese la dirección.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary w-100" name="actualizarProveedor" type="submit">Actualizar proveedor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>