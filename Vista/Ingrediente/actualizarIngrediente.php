<?php

$idIngrediente = $_GET['idIngrediente'];

if (isset($_POST['actualizar-ingrediente'])) {

    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $proveedor = $_POST['proveedor'];

    $Ingrediente = new Ingrediente($idIngrediente, $nombre, $cantidad, $proveedor);
    $alert = $Ingrediente -> actualizarIngrediente();

    if($alert == 1){
        $msj = "El ingrediente ha sido actualizado satisfactoriamente";
        $class = "alert-success";
    }else if($alert == 0){
        $msj = "Por favor modifique algun campo";
        $class = "alert-warning";
    }else{
        $msj = "Ha ocurrido algo inesperado";
        $class = "alert-danger";
    }

    include "Vista/Main/error.php";

}else{
    $Ingrediente = new Ingrediente($idIngrediente);
    $Ingrediente -> getInfoBasic();
}


$Proveedor = new Proveedor();

$resultados = $Proveedor -> buscarTodo();

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Actualice su producto
                </div>
                <div class="card-body">
                    <form action="index.php?pid=<?php echo base64_encode("Vista/Ingrediente/actualizarIngrediente.php") ?>&idIngrediente=<?php echo $idIngrediente?>" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Nombre</label>
                            <input value="<?php echo $Ingrediente -> getNombre() ?>" class="form-control" name="nombre" type="text" required>
                        </div>
                        <div class="form-group">
                            <label>Cantidad</label>
                            <input type="number" class="form-control" name="cantidad" value ="<?php echo $Ingrediente -> getCantidad()?>"> 
                        </div>
                        <div class="form-group">
                            <label>Proveedor</label>
                            <select class="form-control" name="proveedor" required>
                                <?php
                            
                                foreach ($resultados as $res) {
                                    if( $res -> getIdProveedor() == $Ingrediente -> getProveedor()){
                                        echo "<option value=" . $res -> getIdProveedor() . " selected>" . $res -> getNombre() . "</option>";
                                    }else{
                                        echo "<option value=" . $res -> getIdProveedor() . " >" . $res -> getNombre() . "</option>";
                                    }
                                    
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control btn btn-primary" name="actualizar-ingrediente" type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>