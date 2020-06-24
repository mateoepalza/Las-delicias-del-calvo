<?php

    $idProducto = $_GET['idProducto'];

    $producto = new Producto($idProducto);
    $producto -> getInfo();

?>

<div>

</div>

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
                    <form class="d-flex" action="index.php?pid=<?php echo base64_encode("Vista/Cliente/Main.php") ?>&idProducto=<?php echo $idProducto ?>" method="POST">
                        
                        <div class="col-4">
                            <span>Cantidad</span>
                            <div> 
                                <input name="cantidad" type="number" value="1" min="1" max="100" step="1"/>
                            </div>
                        </div>
                        <div class="col-8 d-flex flex-column justify-content-end">
                            <input type="submit" name="carrito" class="form-control btn btn-primary" value="Añadir al carrito">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="static/js/bootstrap-input-spinner.js"></script>
<script>
    $("input[type='number']").inputSpinner();
</script>