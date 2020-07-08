<?php

$pagina = 1;
$numReg = 5;

$category = $_GET['idCategoria'];
$categoria = new Categoria($category);
$categoria->buscarxID();

$producto = new Producto();
//$productosDest = $producto->getProductsByCategory($category);
$productosDest = $producto->getProductsByCategoryPaginado($category, $pagina, $numReg);
$cantPag = $producto->buscarCantidadByCategory($category);
$pagination = $cantPag / $numReg;
?>
<div class="container mt-4">
    <div class="row d-flex flex-row justify-content-center">

        <h1><?php echo $categoria->getNombre() ?></h1>

    </div>
    <div class="row product-container mt-4">
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
    <div class="row d-flex flex-row justify-content-center">
        <div class="col-8 d-flex flex-row justify-content-center">
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item page-item-list disabled" id="page-previous" data-page="<?php echo ($pagina - 1) ?>">
                        <span class="page-link">Previous</span>
                    </li>
                    <?php
                    for ($i = 0; $i < $pagination; $i++) {
                    ?>
                        <li class="page-item page-item-list page-numbers <?php echo (($i + 1) == $pagina) ? "active" : ""; ?>" data-page="<?php echo ($i + 1); ?>"><a class="page-link" href="#"><?php echo ($i + 1); ?></a></li>
                    <?php
                    }
                    ?>
                    <li class="page-item page-item-list <?php echo ($pagination > 1)? "" : "disabled"?>" id="page-next" data-page="<?php echo ($pagina + 1) ?>">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {

        /*
         * Evento de buscar en la tabla
         */
        let timeout;
        $("#search-product").on('keyup', function() {
            clearTimeout(timeout)
            timeout = setTimeout(() => {
                json = {
                    "page": "1",
                    "search": $(this).val(),
                    "category": <?php echo $category ?>
                };

                $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/Producto/Ajax/productoCategoria.php") ?>", json, function(data) {

                    res = JSON.parse(data);
                    // Imprime los datos de la tabla
                    tablePrint(res.DataT, res.DataL);
                    //Imprime la paginación
                    paginationPrint(res.DataP, parseInt(res.Cpage));

                });
                clearTimeout(timeout)
            }, 250)

        });

        /*
         * Evento de cambiar de página
         */

        $(".pagination").on('click', ".page-item-list", function() {
            json = {
                "page": $(this).data("page"),
                "search": $("#search-product").val(),
                "category": <?php echo $category ?>
            };

            $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/Producto/Ajax/productoCategoria.php") ?>", json, function(data) {
                console.log(data);
                res = JSON.parse(data);
                //imprime los datos en la tabla
                tablePrint(res.DataT, res.DataL);
                //Imprime paginación
                paginationPrint(res.DataP, parseInt(res.Cpage));
            });
        })

    });

    /*
     * Imprime los datos en la tabla
     */
    function tablePrint(DataT, DataL) {
        $(".product-container").empty();

        DataT.forEach(function(data) {
            $(".product-container").append(
                `<div class="product">
                <a href="index.php?pid=${DataL}&idProducto=${data[0]}" class="img-producto">
                    <img src="${data[2]}" class="img-fluid img-portfolio img-hover">
                </a>
                <h4 class="product-title">${data[1]}</h4>
                <div class="product-info">
                    <span class="precio-descrip">Desde </span>
                    <span class="precio-producto">$${data[3]}</span>
                </div>
            </div>`
            )
        });
    }
    /*
     * Imprime la paginación de la tabla
     */
    function paginationPrint(cantPag, actualPage) {
        $(".page-numbers").remove();
        updateBefore(actualPage - 1);
        updateNext(actualPage + 1, Math.ceil(cantPag));
        for (let i = 0; i < cantPag; i++) {
            if ((i + 1) == actualPage) {
                $("#page-next").before("<li class='page-item page-item-list page-numbers active' data-page='" + (i + 1) + "'><a class='page-link' href='#'>" + (i + 1) + "</a></li>")
            } else {
                $("#page-next").before("<li class='page-item page-item-list page-numbers' data-page='" + (i + 1) + "'><a class='page-link' href='#'>" + (i + 1) + "</a></li>");
            }

        }
    }

    /*
     * Actualiza los botones anterior y siguiente
     */
    function updateBefore(previousNumber) {
        if (previousNumber <= 0) {
            $("#page-previous").addClass("disabled");
            $("#page-previous").data("page", 0);
        } else {
            $("#page-previous").removeClass("disabled");
            $("#page-previous").data("page", previousNumber);
        }

    }

    function updateNext(nextNumber, cantPag) {
        if (nextNumber > cantPag) {
            $("#page-next").addClass("disabled");
            $("#page-next").data("page", cantPag);

        } else {
            $("#page-next").data("page", nextNumber);
            $("#page-next").removeClass("disabled");
        }

    }
</script>