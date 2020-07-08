<?php

$nombre = "";

if (isset($_POST['sent'])) {
    $nombre = $_POST['nombre'];
    $categoria = new Categoria("", $nombre);
    $res = $categoria->insertar();

    if ($res == 1) {
        $msj = "La categoria se ha creado satisfactoriamente";
        $class = "alert-success";
    } else {
        $msj = "Ocurrió algo inesperado, intente de nuevo.";
        $class = "alert-danger";
    }

    include "Vista/Main/error.php";
}
?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <h1>Ingresar Categoría</h1>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-11 col-md-12 col-lg-9 col-xl-8">
            <div class="card">
                <div class="card-header">
                    Ingrese una nueva categoría
                </div>
                <div class="card-body">
                    <form novalidate class="needs-validation" action="index.php?pid=<?php echo base64_encode("Vista/Categoria/crearCategoria.php") ?>" method="POST">

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
                            <button class="btn btn-primary w-100" name="sent" type="submit">Crear categoría </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>