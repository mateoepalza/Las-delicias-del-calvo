<?php

    $idProducto = $_GET['idProducto'];

    $carrito = dSerializeC();
    $cantidadProducto = $carrito -> buscarCantidadProductoCarrito($idProducto);

    $producto = new Producto($idProducto);
    $producto -> getInfo();
    $gotIngredients = $producto -> cantIngrediente();

    $InStock = $carrito -> getStock($idProducto, 1);

?>

<div>

</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-12  col-lg-6">
            <img src="<?php echo $producto -> getFoto() ?>" width="100%">
        </div>
        <div class="col-12  col-lg-6 ">
            <div class="description border-bottom container-out">
                <span class="description-title"><?php echo $producto -> getNombre() ?></span>
                <span class="description-price">$<?php echo number_format($producto -> getPrecio()) ?></span>
                <?php
                    if(!$InStock){
                        ?>
                            <span class="out-stock">Out of stock</span>
                        <?php
                    }
                    if($gotIngredients <= 0){
                        ?>
                            <span class="out-stock">Producto descontinuado</span>
                        <?php
                    }
                ?>
                
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
                                <input id="in-cantidad" name="cantidad" type="number" value="<?php echo $cantidadProducto ?>" min="1" max="100" step="1" data-id="<?php echo $idProducto ?>" <?php echo (!$InStock|| $gotIngredients <= 0)? "disabled":""; ?> />
                            </div>
                        </div>
                        <div class="col-8 d-flex flex-column justify-content-end">
                            <input id="agregarCarrito" type="submit" name="carrito" class="form-control btn btn-primary" value="Añadir al carrito" <?php echo (!$InStock || $gotIngredients <= 0)? "disabled":""; ?>>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="static/js/bootstrap-input-spinner.js"></script>
<script type="text/javascript">
    $("input[type='number']").inputSpinner();
    $(function(){
        $("#in-cantidad").on('change', function(){
            let json = {
                "idProducto" : $(this).data("id"),
                "cantidad" : $(this).val()
            };
            
            $.post('indexAJAX.php?pid=<?php echo base64_encode("Vista/Checkout/Ajax/descripProdOutStock.php") ?>', json, function(data){
                console.log(data);
                res = JSON.parse(data);
                if(res.status){
                    inStock();
                }else{
                    outStock();
                }
            });
        });
    });

    function outStock(){
        if($(".out-stock").length <= 0){
            $(".container-out").append(`<span class="out-stock">Out of stock</span>`);
        }
        $("#agregarCarrito").prop('disabled', true);
        //$("#in-cantidad").prop("disabled", true);
    }
    
    function inStock(){
        $(".out-stock").remove();
        $("#agregarCarrito").prop('disabled', false);
        //$("#in-cantidad").prop("disabled", false);
    }

</script>