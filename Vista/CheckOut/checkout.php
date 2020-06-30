<?php

$carrito = dSerializeC();
$listaProductos =  $carrito -> searchCarritoItems();
$totalPrice = $carrito -> getTotalPriceList();
serializeC($carrito);

$Cliente = new Cliente($_SESSION['id']);
$Cliente->getInfoBasic();

?>

<div class="container mt-4">
    <div class="row d-flex flex-row justify-content-center">

        <h1>Checkout</h1>

    </div>
    <div class="row product-container mt-3">
        <div class="col-8">
            <?php

            foreach ($listaProductos as $prod) {
            ?>
                <div class="row row-checkout-product border-bottom pt-5 pb-5">
                    <div class="col-3">
                        <img src="<?php echo $prod[0]->getFoto() ?>" width="100%">
                    </div>
                    <div class="col-3">
                        <span class="checkout-p-title"><?php echo $prod[0]->getNombre() ?></span>

                        <span class="checkout-p-desc"><?php echo $prod[0]->getDescripcion() ?></span>
                    </div>
                    <div class="col-3">
                        <input class="spinner" name="cantidad" type="number" value="<?php echo $prod[1] ?>" data-id="<?php echo $prod[0]->getIdProducto() ?>" min="1" max="100" step="1" />
                    </div>
                    <div class="col-2">$<?php echo number_format($prod[0]->getPrecio(), 2, ",", ".") ?></div>
                    <div class="col-1 close-product" data-id="<?php echo $prod[0]->getIdProducto() ?>" style="cursor:pointer;">x</div>
                </div>

            <?php
            }

            ?>

            <div class="row  d-flex flex-row justify-content-end mt-3">
                <div class="col-4">
                    <div class="d-flex flex-row justify-content-between">
                        <span class="checkout-check-title">Subtotal</span>
                        <span id="checkout-ck-value" class="checkout-check-value">$<?php echo number_format($totalPrice, 2, ",", ".") ?></span>
                    </div>
                    <div class="d-flex flex-row justify-content-between">
                        <span class="checkout-check-title">Shopping</span>
                        <span class="checkout-check-value">Free</span>
                    </div>
                    <div class="d-flex flex-row justify-content-between border-top">
                        <span class="checkout-total">Total:</span>
                        <span class="checkout-total" id="checkout-total-value">$<?php echo number_format($totalPrice, 2, ",", ".") ?></span>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-4">
            <div class="p-4" style="background-color: #f9f9f9;">
                <h2 class="mb-4" style="letter-spacing:2px;">Payment info.</h2>
                <div>
                    <form novalidate class="needs-validation" action="index.php?pid=<?php echo base64_encode("Vista/CheckOut/checkout.php") ?>" method="POST">
                        <div class="form-group">
                            <span class="p-method-title">Payment method</span>
                            <div class="custom-control custom-radio p-method-radio">
                                <input type="radio" class="form-check-input" name="paymentMethod" required>
                                <label><i class="fas fa-credit-card"></i> Credir Card</label>
                            </div>
                            <div class="custom-control custom-radio p-method-div p-method-radio">
                                <input type="radio" class="form-check-input" name="paymentMethod" required>
                                <label><i class="fab fa-cc-paypal"></i> Paypal</label>
                                <div class="invalid-feedback">
                                    Por favor seleccione un estado.
                                </div>
                                <div class="valid-feedback">
                                    ¡Enhorabuena!
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="p-method-title">Name on card</span>
                            <div class="p-method-div">
                                <span><?php echo ($Cliente->getNombre() == "") ? $Cliente->getCorreo() : $Cliente->getNombre() . " " . $Cliente->getApellido(); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="p-method-title">Card Number</span>
                            <div class="p-method-div">
                                <span>&#8226;&#8226;&#8226;&#8226; &#8226;&#8226;&#8226;&#8226; &#8226;&#8226;&#8226;&#8226; 5698</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="p-method-title">Expiration Date</span>
                            <div class="p-method-div">
                                <div>
                                    <input type="month" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Por favor seleccione un estado.
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Enhorabuena!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="p-method-title">CVV</span>
                            <div class="p-method-div">
                                <div>
                                    <input class="form-control" type="number" min="100" max="999" required>
                                </div>
                            </div>
                        </div>

                        <button type="submit" id="btn-checkout" name="btnCheckout" class="btn btn-primary w-100">Pagar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="static/js/bootstrap-input-spinner.js"></script>
<script>
    $(".spinner").inputSpinner();
    $(function() {
        $(".spinner").on('change', function() {
            let obj = $(this);
            let json = {
                "idProducto": $(this).data("id"),
                "amount": $(this).val()
            }

            $.post("indexAJAX.php?pid=<?php echo base64_encode('Vista/Checkout/Ajax/checkoutSum.php') ?>", json, function(data) {
                console.log(data);
                res = JSON.parse(data);
                if (res.status) {
                    actualizarPrecios(res.data.totalPrice);
                    inStock();
                } else {
                    outStock(obj);
                }

            });

        });

        $(".close-product").on("click", function() {
            let parent = $(this).parent();
            let json = {
                "idProducto": $(this).data("id")
            };
            console.log(json);
            $.post("indexAJAX.php?pid=<?php echo base64_encode('Vista/Checkout/Ajax/deleteCheckout.php') ?>", json, function(data) {
                console.log(data);
                res = JSON.parse(data);

                if (res.status) {
                    borrarProducto(parent);
                } else {
                    crearAlert("alert-danger", res.msj);
                }

                actualizarPrecios(res.data.totalPrice);
                actualizarCantCarrito(res.data.itemsCarrito);


            });
        });
    });

    function inStock() {
        $("#btn-checkout").prop("disabled", false);
        $(".out-stock").remove();
    }

    function outStock(obj) {
        if ($(".out-stock").length <= 0) {
            obj.after(`<span class="out-stock">Out of stock</span>`);
        }
        $("#btn-checkout").prop('disabled', true);
    }

    function actualizarCantCarrito(cant) {
        if (cant != 0) {
            $(".num-products").text(cant);
        } else {
            $(".num-products").remove();
        }

    }

    function actualizarPrecios(precio) {
        $("#checkout-ck-value").text(`$${precio}`);
        $("#checkout-total-value").html(`$${precio}`);
    }

    function borrarProducto(elem) {
        elem.remove();
    }

    function crearAlert(className, msj) {
        $("#alert-ajax").html(
            `<div class="alert ${className} alert-dismissible fade show" role="alert" style="text-align: center; position: fixed; width: 100%;">
                <span id="alert-ajax-msj">${msj}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>`
        );
    }
</script>