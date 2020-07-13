<?php

$idIngrediente = $_GET['idIngrediente'];

if (isset($_POST['actualizarStock'])) {

    $cantidad = $_POST['cantidad'];

    $Ingrediente = new Ingrediente($idIngrediente);
    $Ingrediente->getInfoBasic();
    $Ingrediente -> setCantidad($Ingrediente -> getCantidad() + $cantidad);

    $alert = $Ingrediente->actualizarCantidad();

    if ($alert == 1) {

        /**
         * Creo un objeto para retornar el dia y la hora
         */
        $date = new DateTime();
        /**
         * Creo un objeto Proveedor
         */
        $proveedorObj = new Proveedor($Ingrediente -> getProveedor());
        /**
         * Busco el nombre de la Proveedor
         */
        $proveedorObj->getInfo();

        if ($_SESSION['rol'] == 3) {
            /**
             * Creo el objeto de log
             */
            $logInventarista = new LogInventarista("", $date->format('Y-m-d H:i:s'), LogHActualizarIngrediente($Ingrediente -> getIdIngrediente(), $Ingrediente -> getNombre(), $Ingrediente -> getCantidad(), $proveedorObj->getNombre()), 25, getBrowser(), getOS(), $_SESSION['id']);
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
    }
    else {
        $msj = "Ha ocurrido algo inesperado";
        $class = "alert-danger";
    }

    include "Vista/Main/error.php";
} else {
    $Ingrediente = new Ingrediente($idIngrediente);
    $Ingrediente->getInfoBasic();
}

$Proveedor = new Proveedor($Ingrediente->getProveedor());
$Proveedor-> getInfo();


?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <h1>Agregar a Stock</h1>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-11 col-md-12 col-lg-9 col-xl-8">
            <div class="card">
                <div class="card-header">
                    Agregar a Stock
                </div>
                <div class="card-body">
                    <form novalidate class="needs-validation" action="index.php?pid=<?php echo base64_encode("Vista/Ingrediente/agregarInventario.php") ?>&idIngrediente=<?php echo $idIngrediente ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6">
                                <label>Nombre</label>
                                <input value="<?php echo $Ingrediente->getNombre() ?>" class="form-control"  type="text" disabled>
                                <input type="hidden" name="idIngrediente" value="<?php echo $idIngrediente ?>">
                                <div class="invalid-feedback">
                                    Por favor ingrese el nombre.
                                </div>
                                <div class="valid-feedback">
                                    ¡Enhorabuena!
                                </div>
                            </div>
                            <div class="col-6">
                                <label>Proveedor</label>
                                <input type="text" value="<?php echo $Proveedor -> getNombre() ?>" class="form-control" disabled>
                                <div class="invalid-feedback">
                                    Por favor ingrese seleccione algún proveedor.
                                </div>
                                <div class="valid-feedback">
                                    ¡Enhorabuena!
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <label>En stock</label>
                            <input type="number" class="form-control" value="<?php echo $Ingrediente->getCantidad() ?>" disabled>
                            <div class="invalid-feedback">
                                Por favor ingrese la cantidad.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <label>En stock</label>
                            <input type="number" min = "1" max = "999" class="form-control" name="cantidad" placeholder="Agregar la entrada" required>
                            <div class="invalid-feedback">
                                Por favor ingrese la cantidad.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <button class="btn btn-primary w-100" name="actualizarStock" type="submit">Agregar a Stock</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>