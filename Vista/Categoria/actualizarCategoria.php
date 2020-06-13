<?php

    if(isset($_POST['sent'])){
        $categoria = new Categoria($_GET['idCategoria'], $_POST['nombre']);
        $res = $categoria -> actualizarCategoria();
        if($res == 1){
            $class="alert-success";
            $msj = "El registro ha sido actualizado correctamente.";
        }else if($res == 0){
            $class="alert-warning";
            $msj = "No hubo ningun cambio";
        }else{
            $class="alert-danger";
            $msj = "hubo un error en el procesamiento.";
        }
        include "Vista/Main/error.php";

    }else{
        $categoria = new Categoria($_GET['idCategoria']);
        $categoria -> buscarxID();
    }

    

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Actualice la categoria
                </div>
                <div class="card-body">
                    <form action="index.php?pid=<?php echo base64_encode("Vista/Categoria/actualizarCategoria.php") ?>&idCategoria=<?php echo $_GET['idCategoria']?>" method="POST">
                        <div class="form-group">
                            <label>nombre</label>
                            <input class="form-control" name="nombre" type="text" value="<?php echo $categoria -> getNombre() ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control btn btn-primary" name="sent" type="submit">
                        </div>
                    </form>
                    <div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>