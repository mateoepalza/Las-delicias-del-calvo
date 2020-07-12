<?php

$idIngrediente = $_GET['idIngrediente'];

if (isset($_POST['actualizar-ingrediente'])) {

    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $proveedor = $_POST['proveedor'];

    $Ingrediente = new Ingrediente($idIngrediente, $nombre, $cantidad, $proveedor);
    $alert = $Ingrediente->actualizarIngrediente();

    if ($alert == 1) {

        /**
         * Creo un objeto para retornar el dia y la hora
         */
        $date = new DateTime();
        /**
         * Creo un objeto Proveedor
         */
        $proveedorObj = new Proveedor($proveedor);
        /**
         * Busco el nombre de la Proveedor
         */
        $proveedorObj->getInfo();

        if ($_SESSION['rol'] == 1) {
            /**
             * Creo el objeto de log
             */
            $logAdmin = new LogAdmin("", $date->format('Y-m-d H:i:s'), LogHActualizarIngrediente($idIngrediente, $nombre, $cantidad, $proveedorObj->getNombre()), 7, getBrowser(), getOS(), $_SESSION['id']);
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
            $logInventarista = new LogInventarista("", $date->format('Y-m-d H:i:s'), LogHActualizarIngrediente($idIngrediente, $nombre, $cantidad, $proveedorObj->getNombre()), 7, getBrowser(), getOS(), $_SESSION['id']);
            /**
             * Inserto el registro del log
             */
            $logInventarista->insertar();

            /**
             * Log para el Inventarista
             */
        }

        $msj = "El ingrediente ha sido actualizado satisfactoriamente";
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
    $Ingrediente = new Ingrediente($idIngrediente);
    $Ingrediente->getInfoBasic();
}


$Proveedor = new Proveedor();

$resultados = $Proveedor->buscarTodo();

?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <h1>Actualizar Ingrediente</h1>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-11 col-md-12 col-lg-9 col-xl-8">
            <div class="card">
                <div class="card-header">
                    Actualice un ingrediente
                </div>
                <div class="card-body">
                    <form novalidate class="needs-validation" action="index.php?pid=<?php echo base64_encode("Vista/Ingrediente/actualizarIngrediente.php") ?>&idIngrediente=<?php echo $idIngrediente ?>" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Nombre</label>
                            <input value="<?php echo $Ingrediente->getNombre() ?>" class="form-control" name="nombre" type="text" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el nombre.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Cantidad</label>
                            <input type="number" class="form-control" name="cantidad" value="<?php echo $Ingrediente->getCantidad() ?>" required>
                            <div class="invalid-feedback">
                                Por favor ingrese la cantidad.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Proveedor</label>
                            <select class="form-control" name="proveedor" required>
                                <?php

                                foreach ($resultados as $res) {
                                    if ($res->getIdProveedor() == $Ingrediente->getProveedor()) {
                                        echo "<option value=" . $res->getIdProveedor() . " selected>" . $res->getNombre() . "</option>";
                                    } else {
                                        echo "<option value=" . $res->getIdProveedor() . " >" . $res->getNombre() . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                Por favor ingrese seleccione algún proveedor.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary w-100" name="actualizar-ingrediente" type="submit">Actualizar ingrediente</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>