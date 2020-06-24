<?php

if(isset($_POST['crear-ingrediente'])){

    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $FK_idProveedor = $_POST['proveedor'];

    $ingrediente = new Ingrediente("", $nombre, $cantidad, $FK_idProveedor);
    $alert = $ingrediente -> insertar();

    if($alert == 1){
        $msj = "El ingrediente fue almacenado satisfactoriamente";
        $class = "alert-success";
    }else{
        $msj = "Ocurrió algo inesperado";
        $class = "alert-danger";
    }
    include "Vista/Main/error.php";
}

$Proveedor = new Proveedor();
$resultados = $Proveedor -> buscarTodo();
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Ingrese un nuevo ingrediente
                </div>
                <div class="card-body">
                    <form action="index.php?pid=<?php echo base64_encode("Vista/Ingrediente/crearIngrediente.php") ?>" method="POST">

                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" name="nombre" type="text" required>
                        </div>
                        <div class="form-group">
                            <label>Cantidad</label>
                            <input class="form-control" name="cantidad" type="number" required>
                        </div>
                        <div class="form-group">
                            <label>Proveedor</label>
                            <select class="form-control" name="proveedor" required>
                                <option selected value="" disabled>- Seleccione -</option>
                                <?php
                                foreach ($resultados as $res) {
                                    echo "<option value=" . $res -> getIdProveedor() . ">" . $res -> getNombre() . "</option>";
                                }
                                ?>
                            </select>
                        </div> 
                        <div class="form-group">
                            <input class="form-control btn btn-primary" name="crear-ingrediente" type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>