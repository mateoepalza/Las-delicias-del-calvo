<?php

    $idProducto = $_GET['idProducto'];

    $producto = new Producto($idProducto);
    $producto -> getInfo();

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-md-7 col-lg-6">
            <img src="<?php echo $producto -> getFoto() ?>" width="100%">
        </div>
        <div class="col-12 col-md-5 col-lg-6">
            <div class="description border-bottom">
                <span class="description-title"><?php echo $producto -> getNombre() ?></span>
                <span class="description-price">$<?php echo number_format($producto -> getPrecio()) ?></span>
            </div>
            <div class="description border-bottom">
                <span class="description-desc-title">Descripción</span>
                <span class="description-real-desc-title"><?php echo $producto -> getDescripcion() ?></span>
            </div>
            <div class="description border-bottom">
                <div class="row">
                    <div class="col-4">
                        <span>Cantidad</span>
                        <div></div>
                    </div>
                    <div class="col-8">
                        <button class="form-control btn btn-primary">Añadir al carrito</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>