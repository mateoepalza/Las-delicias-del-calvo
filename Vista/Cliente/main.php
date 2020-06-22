<?php
$producto = new Producto();
$productosDest= $producto ->getDestProducts();
?>

<div id="carouselExampleCaptions" class="carousel slide mb-5" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active" style="height: 600px; overflow: hidden">
            <div style="background : rgba(0,0,0,0.5); width : 100%; height : 100%; position: absolute">
            </div>
            <div class="w-100 h-100" style="background-Image: url('static/img/bg1.jpg'); background-position: center; background-repeat: no-repeat; background-size: cover"></div>
            <div class="carousel-caption d-none d-md-block">
                <h5>First slide label</h5>
                <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
            </div>
        </div>
        <div class="carousel-item" style="height: 600px; overflow: hidden">
            <div style="background : rgba(0,0,0,0.5); width : 100%; height : 100%; position: absolute">
            </div>
            <div class="w-100 h-100" style="background-Image: url('static/img/bg2.jpg'); background-position: center; background-repeat: no-repeat; background-size: cover"></div>
            <div class="carousel-caption d-none d-md-block">
                <h5>Second slide label</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>
        <div class="carousel-item" style="height: 600px; overflow: hidden">
            <div style="background : rgba(0,0,0,0.5); width : 100%; height : 100%; position: absolute">
            </div>
            <div class="w-100 h-100" style="background-Image: url('static/img/bg3.jpg'); background-position: center; background-repeat: no-repeat; background-size: cover"></div>
            <div class="carousel-caption d-none d-md-block">
                <h5>Third slide label</h5>
                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="container mt-4">
    <div class="row d-flex flex-row justify-content-center">

        <h1>Productos destacados</h1>

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
        <!--<div class="product">
            <a href="index.php?pid=<?php echo base64_encode("Vista/Producto/descripProducto.php") ?>&idProducto=1" class="img-producto">
                <img src="static/img/Productos/fresas.png" class="img-fluid img-portfolio img-hover">
            </a>
            <h4 class="product-title">Hamburguesa</h4>
            <div class="product-info">
                <span class="precio-descrip">Desde </span>
                <span class="precio-producto">$16.000</span>
            </div>
        </div>
        <div class="product">
            <a href="#" class="img-producto">
                <img src="static/img/Productos/maracuya.png" class="img-fluid img-portfolio img-hover">
            </a>
            <h4 class="product-title">Hamburguesa</h4>
            <div class="product-info">
                <span class="precio-descrip">Desde </span>
                <span class="precio-producto">$16.000</span>
            </div>
        </div>
        <div class="product">
            <a href="#" class="img-producto">
                <img src="static/img/Productos/fresas.png" class="img-fluid img-portfolio img-hover">
            </a>
            <h4 class="product-title">Hamburguesa</h4>
            <div class="product-info">
                <span class="precio-descrip">Desde </span>
                <span class="precio-producto">$16.000</span>
            </div>
        </div>
        <div class="product">
            <a href="#" class="img-producto">
                <img src="static/img/Productos/maracuya.png" class="img-fluid img-portfolio img-hover">
            </a>
            <h4 class="product-title">Hamburguesa</h4>
            <div class="product-info">
                <span class="precio-descrip">Desde </span>
                <span class="precio-producto">$16.000</span>
            </div>
        </div>
        <div class="product">
            <a href="#" class="img-producto">
                <img src="static/img/Productos/fresas.png" class="img-fluid img-portfolio img-hover">
            </a>
            <h4 class="product-title">Hamburguesa</h4>
            <div class="product-info">
                <span class="precio-descrip">Desde </span>
                <span class="precio-producto">$16.000</span>
            </div>
        </div>
        <div class="product">
            <a href="#" class="img-producto">
                <img src="static/img/Productos/maracuya.png" class="img-fluid img-portfolio img-hover">
            </a>
            <h4 class="product-title">Hamburguesa</h4>
            <div class="product-info">
                <span class="precio-descrip">Desde </span>
                <span class="precio-producto">$16.000</span>
            </div>
        </div>-->
    </div>
</div>