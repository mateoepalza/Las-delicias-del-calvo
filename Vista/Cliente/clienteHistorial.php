<?php

$pagina = 1;
$numReg = 5;

$idCliente = $_SESSION['id'];

$factura = new Factura("", "", "", $idCliente);

$resultados = $factura->buscarPaginadoCliente($pagina, $numReg);


$cantPag = $factura->buscarCantidadCliente();
$pagination = $cantPag / $numReg;


?>

<div class="container">
    <div class="row d-flex flex-row justify-content-center mt-5 mb-5">
        <h1>Historial de compras</h1>
    </div>
    <div class="row" style="min-height: 400px;">
        <div class="col-12">
            <table class="tableHistorial">
                <thead>
                    <tr>
                        <th># de factura</th>
                        <th>Fecha</th>
                        <th>Valor total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tabla">

                    <?php
                    foreach ($resultados as $factura) {
                    ?>
                        <tr>
                            <td><?php echo $factura->getIdFactura() ?></td>
                            <td><?php echo $factura->getFecha() ?></td>
                            <td><?php echo $factura->getValor() ?></td>
                            <th><a href="#" id='moreInfoBtn' data-toggle='modal' data-target='#moreInfo' data-id='<?php echo $factura->getIdFactura() ?>'><i class="fas fa-info"></i></a></th>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>

    </div>
    <div class="row d-flex flex-row justify-content-center">
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
                <li class="page-item page-item-list <?php echo ($pagination == 0)? "disabled":""; ?>" id="page-next" data-page="<?php echo ($pagina + 1) ?>">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<div id="moreInfo" class="modal fade show">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Info factura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-5">

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {

        /*
         * 
         */
        $("#tabla").on('click', "#moreInfoBtn", function() {
            $url = "indexAJAX.php?pid=<?php echo base64_encode("Vista/Factura/AJAX/moreInfoFactura.php") ?>&idFactura=" + $(this).data("id");
            $(".modal-body").load($url);
        });

        /*
         * Evento de buscar en la tabla
         */

        $("#search-product").on('keyup', function() {
            json = {
                "page": "1",
                "cantPag": "5",
                "search": $(this).val()
            };

            $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/Cliente/Ajax/searchBarFacturaCliente.php") ?>", json, function(data) {
                console.log(data);
                res = JSON.parse(data);
                // Imprime los datos de la tabla
                tablePrint(res.DataT, res.DataL);
                //Imprime la paginación
                paginationPrint(res.DataP, parseInt(res.Cpage));

            });
        });

        /*
         * Evento de cambiar de página
         */

        $(".pagination").on('click', ".page-item-list", function() {

            let pag = $(this).data("page");
        
            if(pag == 0){
                pag = 1;
            }
            json = {
                "page": pag,
                "cantPag": "5",
                "search": $("#search-product").val()
            };

            $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/Cliente/Ajax/searchBarFacturaCliente.php") ?>", json, function(data) {
                console.log(data);
                res = JSON.parse(data);
                //imprime los datos en la tabla
                tablePrint(res.DataT, res.DataL);
                //Imprime paginación
                paginationPrint(res.DataP, parseInt(res.Cpage));
            });
        })

        /*
         * Evento de select (cantidad de registros a mostrar)
         */

        $("#select-cantidad").on('change', function() {
            json = {
                "page": "1",
                "cantPag": "5",
                "search": $("#search-product").val()
            };
            console.log(json);
            $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/Cliente/Ajax/searchBarFacturaCliente.php") ?>", json, function(data) {
                console.log(data);
                res = JSON.parse(data);
                //imprime los datos en la tabla
                tablePrint(res.DataT, res.DataL);
                //Imprime paginación
                paginationPrint(res.DataP, parseInt(res.Cpage));
            });
        });

    });

    /*
     * Imprime los datos en la tabla
     */
    function tablePrint(DataT, DataL) {
        $("#tabla").empty();

        DataT.forEach(function(data) {
            $("#tabla").append("<tr><td>" + data[0] + "</td><td>" + data[1] + "</td><td>" + data[2] + "</td><td style='display: flex; flex-flow: row; justify-content: center; align-items:center;'><a href='#' id='moreInfoBtn' data-toggle='modal' data-target='#moreInfo' data-id='" + data[0] + "' style='margin: 0px 2px;'><i class='fas fa-info-circle'></i></a></a></td></tr>")
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