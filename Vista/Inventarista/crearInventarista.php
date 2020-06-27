<?php

if (isset($_POST['crearInventarista'])) {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $clave = $_POST['clave'];
    $estado = $_POST['estado'];

    $inventarista = new Inventarista("", $nombre, $apellido, $email, $clave, "", $estado);
    $res = $inventarista -> insertar();

    if ($res == 1) {
        $msj = "El inventarista se ha creado satisfactoriamente";
        $class = "alert-success";
    } else {
        $msj = "Ocurrió algo inesperado, intente de nuevo.";
        $class = "alert-danger";
    }

    include "Vista/Main/error.php";
}
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <h1>Crear Inventarista</h1>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                <form novalidate class="needs-validation" action="index.php?pid=<?php echo base64_encode("Vista/Inventarista/crearInventarista.php") ?>" method="POST">
                        <div class="form-group">
                            <label>Nombre Completo</label>
                            <div class="row">
                                <div class="col-6">
                                    <input class="form-control" name="nombre" type="text"  required>
                                    <div class="invalid-feedback">
                                        Por favor ingrese el nombre.
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Enhorabuena!
                                    </div>
                                </div>
                                <div class="col-6">
                                    <input class="form-control" name="apellido" type="text"  required>
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
                            <input class="form-control" name="email" type="email"  required>
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
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>