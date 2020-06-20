<?php

$idProducto = $_GET['idProducto'];

$producto = new Producto($idProducto);


$categoria = new Categoria();

$resultados = $categoria->buscarTodo();

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Ingrese un nuevo producto
                </div>
                <div class="card-body">
                    <form action="index.php?pid=<?php echo base64_encode("Vista/Producto/crearProducto.php") ?>" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" name="nombre" type="text" required>
                        </div>
                        <div class="form-group">
                            <label>Categoria</label>
                            <select class="form-control" name="categoria" required>
                                <option selected value="" disabled>- Seleccione -</option>
                                <?php
                                foreach ($resultados as $res) {
                                    echo "<option value=" . $res->getIdCategoria() . ">" . $res->getNombre() . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>descripción</label>
                            <textarea class="form-control" name="descripcion" id="" cols="30" rows="10" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Precio</label>
                            <input class="form-control" name="precio" type="number" required>
                        </div>
                        <div class="form-group">
                            <label>Imagen</label>
                            <input class="form-control" style="border:0px;" name="archivo" type="file">
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