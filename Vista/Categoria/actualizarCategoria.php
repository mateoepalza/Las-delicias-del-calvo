<?php

if (isset($_POST['sent'])) {
    $categoria = new Categoria($_GET['idCategoria'], $_POST['nombre']);
    $res = $categoria->actualizarCategoria();
    if ($res == 1) {
        $class = "alert-success";
        $msj = "El registro ha sido actualizado correctamente.";
    } else if ($res == 0) {
        $class = "alert-warning";
        $msj = "No hubo ningun cambio";
    } else {
        $class = "alert-danger";
        $msj = "hubo un error en el procesamiento.";
    }
    include "Vista/Main/error.php";
} else {
    $categoria = new Categoria($_GET['idCategoria']);
    $categoria->buscarxID();
}



?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <h1>Actualizar Categoría</h1>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Actualice la categoría
                </div>
                <div class="card-body">
                    <form novalidate class="needs-validation" action="index.php?pid=<?php echo base64_encode("Vista/Categoria/actualizarCategoria.php") ?>&idCategoria=<?php echo $_GET['idCategoria'] ?>" method="POST">
                        <div class="form-group">
                            <label>nombre</label>
                            <input class="form-control" name="nombre" type="text" value="<?php echo $categoria->getNombre() ?>">
                            <div class="invalid-feedback">
                                Por favor ingrese el nombre.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary w-100" name="sent" type="submit">Actualizar Categoría</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>