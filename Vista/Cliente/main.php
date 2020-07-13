<?php
$producto = new Producto();
$productosDest = $producto->getDestProducts(0, 10);
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
                <h5>La mejor comida de Bogotá</h5>
                <p>Disfruta del mejor restaurante de comidas rápidas de Bogotá.</p>
            </div>
        </div>
        <div class="carousel-item" style="height: 600px; overflow: hidden">
            <div style="background : rgba(0,0,0,0.5); width : 100%; height : 100%; position: absolute">
            </div>
            <div class="w-100 h-100" style="background-Image: url('static/img/bg2.jpg'); background-position: center; background-repeat: no-repeat; background-size: cover"></div>
            <div class="carousel-caption d-none d-md-block">
                <h5>Comida para todos los gustos</h5>
                <p>Registrate y empieza a degustar todos nuestros platos.</p>
            </div>
        </div>
        <div class="carousel-item" style="height: 600px; overflow: hidden">
            <div style="background : rgba(0,0,0,0.5); width : 100%; height : 100%; position: absolute">
            </div>
            <div class="w-100 h-100" style="background-Image: url('static/img/bg3.jpg'); background-position: center; background-repeat: no-repeat; background-size: cover"></div>
            <div class="carousel-caption d-none d-md-block">
                <h5>Llevamos tu comida donde estes</h5>
                <p>Tenemos domicilios a toda Boogtá las 24 horas del día.</p>
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
                <a href="index.php?pid=<?php echo base64_encode("Vista/Producto/descripProducto.php") ?>&idProducto=<?php echo $prod->getIdProducto() ?>" class="img-producto">
                    <img src="<?php echo $prod->getFoto() ?>" class="img-fluid img-portfolio img-hover">
                </a>
                <h4 class="product-title"><?php echo $prod->getNombre() ?></h4>
                <div class="product-info">
                    <span class="precio-descrip">Desde </span>
                    <span class="precio-producto">$<?php echo number_format($prod->getPrecio()) ?></span>
                </div>
            </div>
        <?php
        }
        ?>

    </div>
</div>

<script>
    $(document).ready(function() {
        let inicio = 10;
        let flag = true;

        $(window).scroll(function() {
            //window.removeEventListener("scroll", scrollF);
            if ($(window).scrollTop() + $(window).height() >= ($(document).height())) {
                load();
            }
            //window.addEventListener("scroll",scrollF, false);
        });

        function load() {
            if (flag) {
                flag = false;
                json = {
                    "inicio": inicio
                };

                $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/Cliente/Ajax/mainInfinity.php") ?>", json, function(data) {
                    //console.log(data)
                    res = JSON.parse(data);
                    if (res.status) {
                        // Imprime los datos de la tabla
                        tablePrint(res.Data, res.DataL);
                        inicio += 10;
                    }
                    flag = true;
                });

            }

        }

        function tablePrint(DataT, dataL) {
            DataT.forEach(function(data) {
                $(".product-container").append(
                    `<div class="product">
                    <a href="index.php?pid=${dataL}&idProducto=${data[0]}" class="img-producto">
                        <img src="${data[2]}" class="img-fluid img-portfolio img-hover">
                    </a>
                    <h4 class="product-title">${data[1]}</h4>
                    <div class="product-info">
                        <span class="precio-descrip">Desde </span>
                        <span class="precio-producto">$${data[3]}</span>
                    </div>
                </div>`
                );
            });
        }
    });
</script>