<?php

$nombre = "";
if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
}

$categoria = "";
if (isset($_POST['categoria'])) {
    $categoria = $_POST['categoria'];
}

$descripcion = "";
if (isset($_POST['descripcion'])) {
    $descripcion = $_POST['descripcion'];
}

$precio = "";
if (isset($_POST['precio'])) {
    $precio = $_POST['precio'];
}

$archivo = "";
if (isset($_POST['archivo'])) {
    $archivo = $_POST['archivo'];
}

if (isset($_POST['sent'])) {

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
                chmod('static/img/Productos/' . $archivo, 0777);
                $producto = new Producto("", $nombre, $url, $descripcion, $precio, $categoria);
                $resInsert = $producto->insertar();
                if ($resInsert == 1) {
                    $class = "alert-success";
                    $msj = "El producto se ha guardado correctamente";
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
    }
}

$categoria = new Categoria();

$resultados = $categoria->buscarTodo();


?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <h1>Ingresar Producto</h1>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-11 col-md-12 col-lg-9 col-xl-8">
            <div class="card">
                <div class="card-header">
                    Ingrese un nuevo producto
                </div>
                <div class="card-body">
                    <form novalidate class="needs-validation" action="index.php?pid=<?php echo base64_encode("Vista/Producto/crearProducto.php") ?>" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" name="nombre" type="text" required>
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
                                <option selected value="" disabled>- Seleccione -</option>
                                <?php
                                foreach ($resultados as $res) {
                                    echo "<option value=" . $res->getIdCategoria() . ">" . $res->getNombre() . "</option>";
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
                            <textarea class="form-control" name="descripcion" id="" cols="30" rows="10" required></textarea>
                            <div class="invalid-feedback">
                                Por favor ingrese una descripción.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Precio</label>
                            <input class="form-control" name="precio" type="number" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el precio.
                            </div>
                            <div class="valid-feedback">
                                ¡Enhorabuena!
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Imagen</label>
                            <input class="form-control" style="border:0px;" name="archivo" type="file">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary w-100" name="sent" type="submit">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>