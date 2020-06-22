<?php

$admin = new Administrador($_SESSION['id']);

$admin->getInfoBasic();

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Productos
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Producto/crearProducto.php") ?>">Crear producto</a>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Producto/buscarProducto.php") ?>">Buscar producto</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Categoria/crearCategoria.php")?>">Crear categoria</a>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Categoria/buscarCategoria.php")?>">Buscar categoria</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Clientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Proveedores</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Seguridad
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Security/buscarCliente.php") ?>">Clientes</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/") ?>">Proveedores</a>
                </div>
            </li>
        </ul>
        <div>
            <span class="mr-4" style="color:#FFF"> <?php echo $admin->getNombre() ?> <?php echo $admin->getApellido() ?></span>
            <a class="btn btn-outline-light" href="index.php?cerrarSesion=True">cerrar Sesion</a>
        </div>
    </div>
</nav>
<div id="alert-ajax">

</div>