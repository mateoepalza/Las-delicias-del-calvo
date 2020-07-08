<?php

$pagina = 1;
$numReg = 5;

$Producto = new Producto();
$resultados = $Producto->buscarPaginado($pagina, $numReg);
$cantPag = $Producto->buscarCantidad();
$pagination = $cantPag / $numReg;
?>
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <h1>Buscar producto</h1>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-12 col-md-12 col-lg-11 col-xl-10">
            <div class="card">
                <div class="card-header bg-dark d-flex flex-row justify-content-between">
                    <a href="index.php?pid=<?php echo base64_encode("Vista/Producto/crearProducto.php") ?>"><button type="button" class="btn btn-outline-light">Crear nuevo</button></a>
                    <select id="select-cantidad">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <input id="search" type="search" placeholder="search">
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Categoria</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="tabla">
                                <?php
                                foreach ($resultados as $resultado) {
                                    echo "<tr>";
                                    echo "<td>" . $resultado->getIdProducto() . "</td>";
                                    echo "<td>" . $resultado->getNombre() . "</td>";
                                    echo "<td>" . $resultado->getPrecio() . "</td>";
                                    echo "<td>" . $resultado->getCategoria() . "</td>";
                                    echo "<td style='display: flex; flex-flow: row; justify-content: center; align-items:center;'><a href='index.php?pid=" . base64_encode("Vista/Producto/actualizarProducto.php") . "&idProducto=" . $resultado->getIdProducto() . "' style='margin: 0px 2px;'><i class='far fa-edit'></i></a><a href='index.php?pid=" . base64_encode("Vista/IngredienteProducto/adicionarIngrediente.php") . "&idProducto=" . $resultado->getIdProducto() . "' style='margin: 0px 2px;'><i class='far fa-plus-square'></i></a></td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex flex-row justify-content-center ">
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
                            <li class="page-item page-item-list" id="page-next" data-page="<?php echo ($pagina + 1) ?>">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {

        /*
         * Evento de buscar en la tabla
         */

        $("#search").on('keyup', function() {
            json = {
                "page": "1",
                "cantPag": $("#select-cantidad").val(),
                "search": $(this).val()
            };

            $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/Producto/Ajax/searchBar.php") ?>", json, function(data) {

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
            json = {
                "page": $(this).data("page"),
                "cantPag": $("#select-cantidad").val(),
                "search": $("#search").val()
            };

            $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/Producto/Ajax/searchBar.php") ?>", json, function(data) {
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
                "cantPag": $(this).val(),
                "search": $("#search").val()
            };

            $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/Producto/Ajax/searchBar.php") ?>", json, function(data) {

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
            $("#tabla").append("<tr><td>" + data[0] + "</td><td>" + data[1] + "</td><td>" + data[2] + "</td><td>" + data[3] + "</td><td style='display: flex; flex-flow: row; justify-content: center; align-items:center;'><a href='index.php?pid=" + DataL[0] + "&idProducto=" + data[0] + "' style='margin: 0px 2px;'><i class='far fa-edit'></i></a><a href='index.php?pid=" + DataL[1] + "&idProducto=" + data[0] + "' style='margin: 0px 2px;'><i class='far fa-plus-square'></i></a></td></tr>")
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