<?php

$category = $_GET['idCategoria'];

$producto = new Producto();
$productosDest = $producto -> getProductsByCategory($category);

$categoria = new Categoria($category);
$categoria -> buscarxID();
?>
<div>

</div>

<div class="container mt-4">
    <div class="row d-flex flex-row justify-content-center">

        <h1><?php echo $categoria -> getNombre() ?></h1>

    </div>
    <div class="row product-container">
        <?php
        foreach ($productosDest as $prod) {
        ?>
            <div class="product">
                <a href="index.php?pid=<?php echo base64_encode("Vista/Producto/descripProducto.php") ?>&idProducto=<?php echo $prod -> getIdProducto() ?>" class="img-producto">
                    <img src="<?php echo $prod -> getFoto()?>" class="img-fluid img-portfolio img-hover">
                </a>
                <h4 class="product-title"><?php echo $prod -> getNombre() ?></h4>
                <div class="product-info">
                    <span class="precio-descrip">Desde </span>
                    <span class="precio-producto">$<?php echo number_format($prod -> getPrecio())?></span>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>