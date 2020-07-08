<?php

$idProducto = $_GET['idProducto'];

if (isset($_POST['sent'])) {

    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $oldUrl = $_POST['url_hidden'];
    $archivo = $_FILES['archivo']['name'];

    if (isset($archivo) && $archivo != "") {

        $archivo = date("Y_m_d_H_i_s_") . $archivo;

        $tipo = $_FILES['archivo']['type'];
        $tamano = $_FILES['archivo']['size'];
        $temp = $_FILES['archivo']['tmp_name'];
        $url = 'static/img/Productos/' . $archivo;

        if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 9000000))) {
            $class = "alert-danger";
            $msj = "El tipo de archivo no es valido o el tamañano es demasiado grande";
        } else {
            if (move_uploaded_file($temp, $url)) {
                
                if (file_exists($oldUrl)) {
                    unlink(trim($oldUrl));
                }

                $producto = new Producto($idProducto, $nombre, $url, $descripcion, $precio, $categoria);
                $resInsert = $producto->actualizarProducto();

                if ($resInsert == 1) {
                    $class = "alert-success";
                    $msj = "El producto se ha guardado correctamente.";
                } else if ($resInsert == 0) {
                    $class = "alert-warning";
                    $msj = "No se ha modificado ningún valor.";
                } else {
                    $class = "alert-danger";
                    $msj = "Ocurrió algo inesperado";
                }
            } else {
                $class = "alert-danger";
                $msj = "Ocurrió algo inesperado";
            }
        }
        include "Vista/Main/error.php";
    } else {

        $producto = new Producto($idProducto, $nombre, $oldUrl, $descripcion, $precio, $categoria);
        $resInsert = $producto->actualizarProducto();

        if ($resInsert == 1) {
            $class = "alert-success";
            $msj = "El producto se ha guardado correctamente";
        } else if ($resInsert == 0) {
            $class = "alert-warning";
            $msj = "No se ha modificado ningún valor.";
        } else {
            $class = "alert-danger";
            $msj = "Ocurrió algo inesperado";
        }

        include "Vista/Main/error.php";
    }
} else {
    $producto = new Producto($idProducto);
    $producto->getInfoBasic();
}








$categoria = new Categoria();

$resultados = $categoria->buscarTodo();

?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <h1>Actualizar Producto</h1>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-11 col-md-12 col-lg-9 col-xl-8">
            <div class="card">
                <div class="card-header">
                    Actualice un producto
                </div>
                <div class="card-body">
                    <form novalidate class="needs-validation" action="index.php?pid=<?php echo base64_encode("Vista/Producto/actualizarProducto.php") ?>&idProducto=<?php echo $idProducto ?>" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Nombre</label>
                            <input value="<?php echo $producto->getNombre() ?>" class="form-control" name="nombre" type="text" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el nombre.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Categoria</label>
                            <select class="form-control" name="categoria" required>
                                <?php

                                foreach ($resultados as $res) {
                                    if ($res->getIdCategoria() == $producto->getCategoria()) {
                                        echo "<option value=" . $res->getIdCategoria() . " selected>" . $res->getNombre() . "</option>";
                                    } else {
                                        echo "<option value=" . $res->getIdCategoria() . " >" . $res->getNombre() . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                Por favor seleccione una categoria.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>descripción</label>
                            <textarea class="form-control" name="descripcion" id="" cols="30" rows="10" required><?php echo $producto->getDescripcion() ?></textarea>
                            <div class="invalid-feedback">
                                Por favor ingrese una descripción.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Precio</label>
                            <input class="form-control" name="precio" type="number" value="<?php echo $producto->getPrecio() ?>" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el precio.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group d-flex flex-column">
                            <label>Imagen</label>
                            <img width="100px" class="m-3" src="<?php echo $producto->getFoto() ?>">
                            <input style="border:0px;" name="archivo" type="file">
                            <input type="hidden" name="url_hidden" value="<?php echo $producto->getFoto() ?> ">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary w-100" name="sent" type="submit">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>