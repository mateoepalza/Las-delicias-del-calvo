<?php

$idCliente = $_SESSION['id'];

if (isset($_POST['actualizarInfoCliente'])) {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $oldUrl = $_POST['url_hidden'];
    $archivo = $_FILES['archivo']['name'];

    
    $administrador = new Administrador("", "", "", $correo);
    $inventarista = new Inventarista("", "", "", $correo);
    $cliente = new Cliente($idCliente);
    $cliente -> getInfoBasic();
    
    if ($cliente -> getCorreo() != $correo && ($administrador->existeCorreo() || $inventarista->existeCorreo() || $cliente -> existeNuevoCorreo($correo))) {

        $msj = "El correo proporcionado ya se encuentra en uso.";
        $class = "alert-danger";

    } else {
        if (isset($archivo) && $archivo != "") {

            $archivo = date("Y_m_d_H_i_s_") . $archivo;
    
            $tipo = $_FILES['archivo']['type'];
            $tamano = $_FILES['archivo']['size'];
            $temp = $_FILES['archivo']['tmp_name'];
            $url = 'static/img/Users/' . $archivo;
    
            if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 9000000))) {
    
                $class = "alert-danger";
                $msj = "El tipo de archivo no es valido o el tamañano es demasiado grande";
                $cliente = new Cliente($idCliente);
                $cliente->getInfoBasic();
            } else {
                if (move_uploaded_file($temp, $url)) {
    
                    if (file_exists($oldUrl)) {
                        unlink(trim($oldUrl));
                    }
    
                    $cliente = new Cliente($idCliente, $nombre, $apellido, $correo, "", trim($url));
                    $res = $cliente -> actualizarBasic();
    
                    if ($res == 1) {
    
                        if ($_SESSION['rol'] == 2) {
                            /**
                             * Creo un objeto para retornar el dia y la hora
                             */
                            $date = new DateTime();
                            /**
                             * Creo el objeto de log
                             */
                            $logCliente = new LogCliente("", $date->format('Y-m-d H:i:s'), LogHActualizarClienteIP($idCliente, $nombre, $apellido, $correo, $url), 22, getBrowser(), getOS(), $_SESSION['id']);
                            /**
                             * Inserto el registro del log
                             */
                            $logCliente->insertar();
                        }
    
                        $class = "alert-success";
                        $msj = "La información se ha guardado correctamente.";
                    } else if ($res == 0) {
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
            $cliente = new Cliente($idCliente, $nombre, $apellido, $correo, "", trim($oldUrl));
            $res = $cliente -> actualizarBasic();
    
            if ($res == 1) {
                if ($_SESSION['rol'] == 2) {
                    /**
                     * Creo un objeto para retornar el dia y la hora
                     */
                    $date = new DateTime();
                    /**
                     * Creo el objeto de log
                     */
                    $logCliente = new LogCliente("", $date->format('Y-m-d H:i:s'), LogHActualizarClienteIP($idCliente, $nombre, $apellido, $correo, $oldUrl), 22, getBrowser(), getOS(), $_SESSION['id']);
                    /**
                     * Inserto el registro del log
                     */
                    $logCliente->insertar();
                }
    
                $class = "alert-success";
                $msj = "La información se ha guardado correctamente";
            } else if ($res == 0) {
                $class = "alert-warning";
                $msj = "No se ha modificado ningún valor.";
            } else {
                $class = "alert-danger";
                $msj = "Ocurrió algo inesperado";
            }
    
        }
    }

    include "Vista/Main/error.php";
    
} else {
    $cliente = new Cliente($idCliente);
    $cliente->getInfoBasic();
}

?>

<div class="container  mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <h1>Información Personal</h1>
    </div>
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-8">
            <form novalidate class="needs-validation" action="index.php?pid=<?php echo base64_encode("Vista/Cliente/infoPersonal.php") ?>" method=POST enctype="multipart/form-data">
                <div class="row d-flex flex-row justify-content-center mb-5">
                    <div style="border-radius: 500px; overflow:hidden; width: 200px; height: 200px; background-image: url('<?php echo ($cliente->getFoto() != "") ? $cliente->getFoto() : "static/img/users/basic.png"; ?>'); background-repeat: no-repeat; background-position: center; background-size: cover;">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label>Nombre</label>
                        <input type="text" name="nombre" value="<?php echo $cliente->getNombre() ?>" class="form-control" required>
                        <div class="invalid-feedback">
                            Por favor ingrese su nombre.
                        </div>
                        <div class="valid-feedback">
                            ¡Enhorabuena!
                        </div>
                    </div>
                    <div class="col-6">
                        <label>Apellido</label>
                        <input type="text" name="apellido" value="<?php echo $cliente->getApellido() ?>" class="form-control" required>
                        <div class="invalid-feedback">
                            Por favor ingrese su apellido.
                        </div>
                        <div class="valid-feedback">
                            ¡Enhorabuena!
                        </div>
                    </div>
                </div>
                <div class="form-group mt-4">
                    <label>Correo</label>
                    <input type="email" name="correo" value="<?php echo $cliente->getCorreo() ?>" class="form-control" required>
                    <div class="invalid-feedback">
                        Por favor ingrese su correo.
                    </div>
                    <div class="valid-feedback">
                        ¡Enhorabuena!
                    </div>
                </div>
                <div class="form-group mt-4">

                    <label>Actualizar foto</label>
                    <input type="hidden" name="url_hidden" value="<?php echo $cliente->getFoto() ?> ">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="archivo" class="custom-file-input" id="imageUpload">
                            <label class="custom-file-label" for="imageUpload">Choose file</label>
                        </div>
                    </div>

                </div>
                <div class="form-group mt-5">
                    <button type="submit" name="actualizarInfoCliente" class="btn btn-primary w-100">Actualizar información</button>
                </div>
            </form>
        </div>
    </div>
</div>