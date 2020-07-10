<?php

$admin = new Administrador($_SESSION['id']);

$admin->getInfoBasic();

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="position: sticky; top: 0px; z-index: 15;">
    <a class="navbar-brand" href="index.php?pid=<?php echo base64_encode("Vista/Administrador/mainAdministrador.php") ?>">Navbar</a>
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
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Ingrediente/crearIngrediente.php")?>">Crear ingrediente</a>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Ingrediente/buscarIngrediente.php")?>">Buscar ingrediente</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?pid=<?php echo base64_encode("Vista/Factura/buscarFactura.php")?>">Facturas</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Proveedores</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Proveedor/crearProveedor.php") ?>">Crear proveedor </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Proveedor/buscarProveedor.php") ?>">Buscar proveedores</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Seguridad
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Security/buscarCliente.php") ?>">Clientes</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Security/buscarInventarista.php") ?>">Inventarista</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Security/buscarLog.php") ?>">Log</a>
                </div>
            </li>
        </ul>
        <div class="menu-right nav-item dropdown">
                <a class="nav-link text-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo ($admin->getNombre() != "") ? $admin->getNombre() . " " . $admin->getApellido() : $admin->getCorreo(); ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Administrador/informacionPersonal.php") ?>">Información Personal</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Administrador/cambiarClaveAdministrador.php") ?>">Cambiar contraseña</a>
                </div>
            </div>
            <div class="menu-right">
                <a class="btn btn-outline-light" style="border:0px;" href="index.php?cerrarSesion=True"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>
    </div>
</nav>
<div id="alert-ajax">

</div>