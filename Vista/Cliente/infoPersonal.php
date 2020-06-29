<?php

$idCliente = $_SESSION['id'];

if(isset($_POST['actualizarInfoCliente'])){

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];

    $cliente = new Cliente($idCliente, $nombre, $apellido, $correo);
    $res = $cliente -> actualizarBasic();

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

}else{
    $cliente = new Cliente($idCliente); 
    $cliente -> getInfoBasic();
}

?>

<div class="container  mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <h1>Información Personal</h1>
    </div>
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-8">
            <form novalidate class="needs-validation" action="index.php?pid=<?php echo base64_encode("Vista/Cliente/infoPersonal.php") ?>" method=POST>
                <div class="row">
                    <div class="col-6">
                        <label>Nombre</label>
                        <input type="text" name="nombre" value="<?php echo $cliente -> getNombre() ?>" class="form-control" required>
                        <div class="invalid-feedback">
                            Por favor ingrese su nombre.
                        </div>
                        <div class="valid-feedback">
                            ¡Enhorabuena!
                        </div>
                    </div>
                    <div class="col-6">
                        <label>Apellido</label>
                        <input type="text" name="apellido" value="<?php echo $cliente -> getApellido() ?>" class="form-control" required>
                        <div class="invalid-feedback">
                            Por favor ingrese su apellido.
                        </div>
                        <div class="valid-feedback">
                            ¡Enhorabuena!
                        </div>
                    </div>
                </div>
                <div class="form-group mt-4">
                    <label>Correo</label>
                    <input type="email" name="correo" value="<?php echo $cliente -> getCorreo() ?>" class="form-control" required>
                    <div class="invalid-feedback">
                        Por favor ingrese su correo.
                    </div>
                    <div class="valid-feedback">
                        ¡Enhorabuena!
                    </div>
                </div>
                <div class="form-group mt-5">
                    <button type="submit" name="actualizarInfoCliente" class="btn btn-primary w-100">Actualizar información</button>
                </div>
            </form>
        </div>
    </div>
</div>