<?php

$idProveedor = $_GET['idProveedor'];

if(isset($_POST['actualizarProveedor'])){

    $nit = $_POST['nit'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $Proveedor = new Proveedor ($idProveedor, $nit, $nombre, $telefono, $direccion);

    $alert = $Proveedor -> actualizarProveedor();
    
    if($alert == 1){
        $msj = "El proveedor ha sido actualizado satisfactoriamente";
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
    $Proveedor = new Proveedor($idProveedor);
    $Proveedor -> getInfo();
}

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Actualice el proveedor
                </div>
                <div class="card-body">
                    <form action="index.php?pid=<?php echo base64_encode("Vista/Proveedor/actualizarProveedor.php") ?>&idProveedor=<?php echo $idProveedor ?>" method="POST">
                        <div class="form-group">
                            <label>NIT</label>
                            <input class="form-control" name="nit" type="number" value="<?php echo $Proveedor -> getNit() ?>" required>
                        </div>
                        <div class="form-group">
                            <label>nombre</label>
                            <input class="form-control" name="nombre" type="text" value="<?php echo $Proveedor -> getNombre() ?>" required>
                        </div>
                        <div class="form-group">
                            <label>telefono</label>
                            <input class="form-control" name="telefono" type="number" value="<?php echo $Proveedor -> getTelefono() ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Dirección</label>
                            <input class="form-control" name="direccion" type="text" value="<?php echo $Proveedor -> getDireccion() ?>" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control btn btn-primary" name="actualizarProveedor" type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>