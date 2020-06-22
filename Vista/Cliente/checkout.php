<?php

?>

<div class="container mt-4">
    <div class="row d-flex flex-row justify-content-center">

        <h1>Checkout</h1>

    </div>
    <div class="row product-container mt-3">
        <div class="col-8">
            <div class="row row-checkout-product border-bottom">
                <div class="col-3">
                    <img src="static/img/productos/maracuya.png" width="100%">
                </div>
                <div class="col-3">
                    <span class="checkout-p-title">Hamburguesa doble queso</span>
                    <span class="checkout-p-desc">hamburguesa con doblequeso, pepinillos, tomate, ...</span>
                </div>
                <div class="col-3">
                    <input name="cantidad" type="number" value="1" min="1" max="100" step="1"/>
                </div>
                <div class="col-2">$145.000</div>
                <div class="col-1">x</div>
            </div>
            <div class="row row-checkout-product border-bottom">
                <div class="col-3">
                    <img src="static/img/productos/fresas.png" width="100%">
                </div>
                <div class="col-3">
                    <span class="checkout-p-title">Hamburguesa doble queso</span>
                    <span class="checkout-p-desc">hamburguesa con doblequeso, pepinillos, tomate, ...</span>
                </div>
                <div class="col-3">
                    <input name="cantidad" type="number" value="1" min="1" max="100" step="1"/>
                </div>
                <div class="col-2">$145.000</div>
                <div class="col-1">x</div>
            </div>
            
            <div class="row  d-flex flex-row justify-content-end mt-3">
                <div class="col-4">
                    <div class="d-flex flex-row justify-content-between">
                        <span class="checkout-check-title">Subtotal</span>
                        <span class="checkout-check-value">$350.000</span>
                    </div>
                    <div class="d-flex flex-row justify-content-between">
                        <span class="checkout-check-title">Shopping</span>
                        <span class="checkout-check-value">Free</span>
                    </div>
                    <div class="d-flex flex-row justify-content-between border-top">
                        <span class="checkout-total">Total:</span>
                        <span class="checkout-total">$350.000</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="p-4" style="background-color: #f9f9f9;">
                <h2 class="mb-4" style="letter-spacing:2px;">Payment info.</h2>
                <div>
                    <span class="p-method-title">Payment method</span>
                    <div class="p-method-div">
                        <input type="radio">
                        <label><i class="fas fa-credit-card"></i> Credir Card</label>
                    </div>
                    <span class="p-method-title">Name on card</span>
                    <div class="p-method-div">
                        <span>Jhon Carter</span>
                    </div>
                    <span class="p-method-title">Card Number</span>
                    <div class="p-method-div">
                        <span>&#8226;&#8226;&#8226;&#8226; &#8226;&#8226;&#8226;&#8226; &#8226;&#8226;&#8226;&#8226; 5698</span>
                    </div>
                    <span class="p-method-title">Expiration Date</span>
                    <div class="p-method-div">
                        <div>
                            <input type="date">
                        </div>
                    </div>
                    <span class="p-method-title">CVV</span>
                    <div class="p-method-div">
                        <div>
                            <input type="text" >
                        </div>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Checkout" style="width: 100%">
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script src="static/js/bootstrap-input-spinner.js"></script>
<script>
    $("input[type='number']").inputSpinner();
</script>