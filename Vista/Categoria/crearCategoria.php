<?php

$nombre = "";

if (isset($_POST['sent'])) {
    $nombre = $_POST['nombre'];
    $categoria = new Categoria("", $nombre);
    $res = $categoria->insertar();

    if ($res == 1) {
        /**
         * Creo un objeto para retornar el dia y la hora
         */
        $date = new DateTime();
        if ($_SESSION['rol'] == 1) {

            /**
             * Creo el objeto de log
             */
            $logAdmin = new LogAdmin("", $date->format('Y-m-d H:i:s'), LogHCrearCategoria($nombre), 4, getBrowser(), getOS(), $_SESSION['id']);
            /**
             * Inserto el registro del log
             */
            $logAdmin->insertar();

            /**
             * Log para el Inventarista
             */
        } else if ($_SESSION['rol'] == 3) {

            /**
             * Creo el objeto de log
             */
            $logInventarista = new LogInventarista("", $date->format('Y-m-d H:i:s'), LogHCrearCategoria($nombre), 4, getBrowser(), getOS(), $_SESSION['id']);
            /**
             * Inserto el registro del log
             */
            $logInventarista->insertar();

            /**
             * Log para el Inventarista
             */
        }

        $msj = "La categoria se ha creado satisfactoriamente";
        $class = "alert-success";
    } else {
        $msj = "Ocurrió algo inesperado, intente de nuevo.";
        $class = "alert-danger";
    }

    include "Vista/Main/error.php";
}
?>

<div class="container mb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-11 col-md-12 col-lg-9 col-xl-9 form-bg">
            <div class="card">
                <div class="card-body">
                    <form novalidate class="needs-validation" action="index.php?pid=<?php echo base64_encode("Vista/Categoria/crearCategoria.php") ?>" method="POST">
                        <div class="form-title">
                            <h1>Ingresar Categoría</h1>
                        </div>
                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" name="nombre" type="text" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el nombre.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary w-100" name="sent" type="submit">Crear categoría </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>