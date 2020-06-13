<?php

    $nombre = "";

    if(isset($_POST['sent'])){
        $nombre = $_POST['nombre'];
        $categoria = new Categoria("", $nombre);
        $categoria -> insertar();
    }
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Ingrese una nueva categoria
                </div>
                <div class="card-body">
                    <form action="index.php?pid=<?php echo base64_encode("Vista/Categoria/crearCategoria.php") ?>" method="POST">

                        <div class="form-group">
                            <label>nombre</label>
                            <input class="form-control" name="nombre" type="text">
                        </div>
                        <div class="form-group">
                            <input class="form-control btn btn-primary" name="sent" type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>