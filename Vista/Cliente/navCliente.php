<?php
/*
 * Agregar al carrito
 */
if (isset($_POST['carrito'])) {

    $idProducto = $_GET['idProducto'];
    $cantProd = $_POST['cantidad'];

    $carrito = dSerializeC();
    $bool = $carrito -> checkCarrito($idProducto);

    $class = "alert-success";

    if ($bool) {

        $alert = $carrito -> actualizarCantidadProducto($idProducto, $cantProd);

        if($alert){
            $msj = "La cantidad del producto ha sido actualizada en el carrito.";
        }else{
            $msj = "La cantidad del producto no sido actualizada en el carrito.";
            $class = "alert-danger";
        }
        
    } else {
        $carrito -> agregarProductoCarrito($idProducto, $cantProd);
        $msj = "El producto ha sido añadido correctamente al carrito.";
    }

    serializeC($carrito);

    include "Vista/Main/error.php";
}


$carrito = dSerializeC();
$itemsCarrito = $carrito -> cantidadItems();

if (isset($_POST['btnCheckout'])) {
    $date = new DateTime();

    $factura = new Factura("",$date -> format('Y-m-d H:i:s'), $carrito -> getTotalPriceList(), $_SESSION['id']);
    $res = $factura->pago();

    if ($res) {
        header("Location: index.php?pid=" . base64_encode("Vista/Factura/buscarFactura.php"));
        $msj = "La cantidad del producto ha sido actualizada en el carrito.";
        $class = "alert-success";
    } else {
        $msj = "Hubo un problema con el pago, intenta de nuevo.";
        $class = "alert-danger";
    }

    include "Vista/Main/error.php";
}

$carrito = dSerializeC();
$itemsCarrito = $carrito -> cantidadItems();

$cliente = new Cliente($_SESSION['id']);
$cliente->getInfoBasic();

$categoria = new Categoria();
$categorias = $categoria->buscarTodo();

?>
<link rel="stylesheet" href="static/css/cliente.css">
<div class="container-fluid bg-white">
    <div class="row"">

        <div class="logo-pos col-xl-3 col-md-4 col-sm-12 col-12 d-flex flex-column justify-content-center align-items-center">
            <div class="input-group" style="width:225px">
                <input id="search-product" class="form-control" type="search" placeholder="Buscar" width="200px">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="validatedInputGroupSelect"><i class="fas fa-search"></i></label>
                </div>
            </div>

        </div>
        <div class=" d-flex p-2 flex-row justify-content-center align-items-center col-xl-6 col-md-4 col-sm-5 col-4">
            <a href="index.php?pid=<?php echo base64_encode("Vista/Cliente/main.php") ?>"><img src="static/img/logoB.png" height="80px"></a>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6 col-8 row d-flex flex-row justify-content-center align-items-center ">
            <div class="menu-right">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo ($cliente->getNombre() != "") ? $cliente->getNombre() . " " . $cliente->getApellido() : $cliente->getCorreo(); ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Cliente/clienteHistorial.php") ?>">Historial de compras</a>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Cliente/infoPersonal.php") ?>">Información personal</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("Vista/Cliente/cambiarClaveCliente.php") ?>">Cambiar contraseña</a>
                </div>
            </div>
            <div class="menu-right">
                <a class="btn btn-outline-light" style=" color: #000; border:0px;" href="index.php?pid=<?php echo base64_encode('Vista/Checkout/checkout.php') ?>"><i class="fas fa-cart-arrow-down"><?php echo ($itemsCarrito > 0) ? "<span class='num-products'>" . $itemsCarrito . "</span>" : ""; ?></i></a>
            </div>
            <div class="menu-right">
                <a class="btn btn-outline-primary" style="border:0px;" href="index.php?cerrarSesion=True"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>
    </div>

</div>
<div class="container-fluid border-top border-bottom" id="navMain">
    <div class="row justify-content-center">
        <div class="col-10 navScroll">
            <nav class="navbar navCliente navbar-expand-md ">
                
                    <ul class="navulCliente m-auto">
                        <?php
                        foreach ($categorias as $cate) {
                        ?>
                            <li class="nav-item d-flex principal-link flex-column justify-content-center">
                                <a class="nav-link nav-link-color" href="index.php?pid=<?php echo base64_encode("Vista/Producto/categorias.php") ?>&idCategoria=<?php echo $cate->getIdCategoria() ?>"><?php echo $cate->getNombre() ?></a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                
            </nav>
        </div>
    </div>
</div>
<script>
    let scrY = 0;
    let bool = true;

    $(function(){
        $('.navScroll').scrollLeft(100);
    })
    


    $('.navScroll').bind('mousewheel DOMMouseScroll', function(e) {
    var scrollTo = null;
    
    if (e.type == 'mousewheel') {
        scrollTo = (e.originalEvent.wheelDelta * -1);
    }
    else if (e.type == 'DOMMouseScroll') {
        scrollTo = 40 * e.originalEvent.detail;
    }

    if (scrollTo) {
        e.preventDefault();
        $(this).scrollLeft(scrollTo + $(this).scrollLeft());
    }
});
</script>