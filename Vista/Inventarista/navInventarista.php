<?php
$invent = new Inventarista($_SESSION['id']);
$invent->getInfoBasic();

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
                    Menú rápido
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Producto/crearProductoCIngredientes.php") ?>">Crear producto</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Producto/buscarProducto.php") ?>">Buscar producto</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ingredientes
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Ingrediente/crearIngrediente.php") ?>">Crear ingrediente</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Ingrediente/buscarIngrediente.php") ?>">Buscar ingrediente</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Productos
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Producto/crearProducto.php") ?>">Crear producto</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Producto/buscarProducto.php") ?>">Buscar producto</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Categoria
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Categoria/crearCategoria.php") ?>">Crear categoria</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Categoria/buscarCategoria.php") ?>">Buscar categoria</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Proveedores
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Proveedor/crearProveedor.php") ?>">Crear proveedor </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Proveedor/buscarProveedor.php") ?>">Buscar proveedores</a>
                </div>
            </li>
        </ul>
        <div>
            <span class="mr-4" style="color:#FFF"> <?php echo ($invent->getNombre() != "") ? $invent->getNombre() . " " . $invent->getApellido() : $invet->getCorreo();   ?> </span>
            <a class="btn btn-outline-light" href="index.php?cerrarSesion=True">cerrar Sesion</a>
        </div>
    </div>
</nav>
<div id="alert-ajax">

</div>