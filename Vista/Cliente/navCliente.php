<?php



if(isset($_POST['carrito'])){

    $idProducto = $_GET['idProducto'];
    $cantProd = $_POST['cantidad'];
    
    $carrito = new Carrito($idProducto, $cantProd);
    $bool = $carrito -> checkCarrito();

    if($bool){
        $alert = $carrito -> actualizarCantidad();
        $msj = "La cantidad del producto ha sido actualizada en el carrito.";
    }else{
        $alert = $carrito -> agregarProducto();
        $msj = "El producto ha sido añadido correctamente al carrito.";
    }
    
    $class = "alert-success";
    include "Vista/Main/error.php";
}

$cliente = new Cliente($_SESSION['id']);
$cliente -> getInfoBasic();

$categoria = new Categoria();
$categorias = $categoria->buscarTodo();

?>
<link rel="stylesheet" href="static/css/cliente.css">
<div class="container-fluid bg-white">
    <div class="row" style="height:100px;">

        <div class="col-lg-3 col-md-4 col-sm-1 col-1 ">

        </div>
        <div id="logoImg" class="col-lg-6 col-md-4 col-sm-5 col-3 ">

        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-8 row d-flex flex-row justify-content-center align-items-center ">
            <div class="menu-right">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo ($cliente->getNombre() != "") ? $cliente->getNombre() . " " . $cliente->getApellido() : $cliente->getCorreo(); ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
            <div class="menu-right">
                <a class="btn btn-outline-light" style=" color: #000; border:0px;" href="index.php?pid=<?php echo base64_encode('Vista/Checkout/checkout.php') ?>"><i class="fas fa-cart-arrow-down"><?php echo (count($_SESSION['carrito']) > 0)? "<span class='num-products'>" . count($_SESSION['carrito']) . "</span>": ""; ?></i></a>    
            </div>
            <div class="menu-right">
                <a class="btn btn-outline-primary" style="border:0px;" href="index.php?cerrarSesion=True"><i class="fas fa-sign-out-alt"></i></a>    
            </div>
        </div>
    </div>

</div>
<nav id="navMain" class="navbar-expand-md border-top border-bottom">
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav m-auto">
            <?php 
                foreach($categorias as $cate){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?pid=<?php echo base64_encode("Vista/Producto/categorias.php") ?>&idCategoria=<?php echo $cate -> getIdCategoria() ?>"><?php echo $cate -> getNombre() ?></a>
                    </li>
                    <?php
                }
            ?>
        </ul>
    </div>
</nav>