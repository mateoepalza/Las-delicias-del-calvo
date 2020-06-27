<?php

$idFactura = $_GET['idFactura'];

$factura = new Factura($idFactura);
$factura->getInfoBasic();

$cliente = new Cliente($factura->getCliente());
$cliente->getInfoBasic();

$FacProd = new FacturaProducto($idFactura);
$IngredFacProd = $FacProd->getProductosFactura();

?>
<div class="row">
    <div class="col-12">
        <table class="table table-borderless ">
            <tbody>
                <tr>
                    <td><b># factura</b></td>
                    <td><?php echo $factura->getIdFactura() ?></td>
                    <td><b>Fecha</b></td>
                    <td><?php echo $factura->getFecha() ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-12 mt-4 mb-4">
        <h3>Información del usuario</h3>
    </div>
    <div class="col-12">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th>Nombre</th>
                    <td><?php echo $cliente->getNombre() . " " . $cliente->getApellido() ?></td>
                </tr>
                <tr>
                    <th>Correo</th>
                    <td><?php echo $cliente->getCorreo() ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-12 mt-4 mb-4">
        <h3>Productos</h3>
    </div>
    <div class="col-12">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                </tr>


            </thead>
            <tbody>
                <?php
                foreach ($IngredFacProd as $item) {
                ?>

                    <tr>
                        <td><?php echo $item -> getProducto() ?></td>
                        <td><?php echo $item -> getCantidad() ?></td>
                        <td><?php echo $item -> getPrecio() ?></td>
                    </tr>

                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <th style="text-align:center;">Valor Total</th>
                    <td><?php echo $factura -> getValor() ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>