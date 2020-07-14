<?php

$pagina = 1;
$numReg = 5;

$Inventarista = new Inventarista();
$cantPag = $Inventarista->buscarCantidad();
$pagination = $cantPag / $numReg;
?>
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <h1>Buscar Inventarista</h1>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-12 col-md-12 col-lg-11 col-xl-11">
            <div class="card">
                <div class="card-header bg-dark d-flex flex-row justify-content-between">
                    <a href="index.php?pid=<?php echo base64_encode("Vista/Inventarista/crearInventarista.php") ?>"><button type="button" class="btn btn-outline-light">Crear nuevo</button></a>
                    <select id="select-cantidad">
                        <option value="5" selected>5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <input id="search" type="text" placeholder="search">
                </div>
                <div class="card-body form-table">
                    <div class="table-responsive-lg">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Email</th>
                                    <th>Estado</th>
                                    <th style="text-align:center;">Servicios</th>
                                </tr>
                            </thead>
                            <tbody id="tabla">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex flex-row justify-content-center ">
                    <nav aria-label="...">
                        <ul class="pagination" id-pag="1">
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
                    <input id="escondido" style="display:none;" type="text" value="1">
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        json = {
            "page": $("#escondido").val(),
            "cantPag": $("#select-cantidad").val(),
            "search": $("#search").val()
        };

        $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/Security/Ajax/searchBarInventarista.php") ?>", json, function(data) {

            res = JSON.parse(data);
            // Imprime los datos de la tabla
            tablePrint(res.DataT, res.DataL);
            //Imprime la paginación
            paginationPrint(res.DataP, parseInt(res.Cpage));

        });
    });
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

            $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/Security/Ajax/searchBarInventarista.php") ?>", json, function(data) {
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
            if ($(this).data("page") != 0) {
                json = {
                    "page": $(this).data("page"),
                    "cantPag": $("#select-cantidad").val(),
                    "search": $("#search").val()
                };

                $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/Security/Ajax/searchBarInventarista.php") ?>", json, function(data) {

                    res = JSON.parse(data);
                    if (res.status) {
                        //imprime los datos en la tabla
                        tablePrint(res.DataT, res.DataL);
                        //Imprime paginación
                        paginationPrint(res.DataP, parseInt(res.Cpage));
                        //actualiza el escondido
                        updateEscondido(parseInt(res.Cpage));
                    }
                });
            }
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
            console.log(json);
            $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/Security/Ajax/searchBarInventarista.php") ?>", json, function(data) {
                console.log(data)
                res = JSON.parse(data);
                //imprime los datos en la tabla
                tablePrint(res.DataT, res.DataL);
                //Imprime paginación
                paginationPrint(res.DataP, parseInt(res.Cpage));
            });
        });

        /*
         *
         */
        $('.table').on('change', '.select-estado', function() {
            json = {
                "idCliente": $(this).data('id'),
                "estado": $(this).val(),
            };
            console.log(json);
            $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/Security/Ajax/updateEstadoInventarista.php") ?>", json, function(data) {
                console.log(data);
                res = JSON.parse(data);
                console.log(res)
                crearAlert(res.status, res.msj);
            });
        });

    });

    /*
     * Update escondido
     */
    function updateEscondido(num) {
        $("#escondido").val(num);
    }

    /*
     * Imprime los datos en la tabla
     */
    function tablePrint(DataT, DataL) {
        $("#tabla").empty();

        DataT.forEach(function(data) {
            $("#tabla").append(`<tr><td>${data[1]}</td><td>${data[2]}</td><td>${data[3]}</td><td><select class='select-estado form-control' data-id='${data[0]}'><option value='1' ${(data[4] == 1)?"selected":""}>Activado</option><option value='0' ${(data[4] == 0)?"selected":""} >Bloqueado</option></select></td><td style='display:flex; justify-content:center;'><a href='index.php?pid=${DataL}&idInventarista=${data[0]}'><i class='far fa-edit'></i></a></td></tr>`)
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

    function crearAlert(status, msj) {
        let className = "";

        if (status) {
            className = "alert-success";
        } else {
            className = "alert-danger";
        }

        $("#alert-ajax").html(`<div class="alert ${className} alert-dismissible fade show" role="alert" style="top: 0px;position: fixed; z-index:20; margin-top : 50px; transform: translateX(-50%); margin-left: 50%">
                        <span id="alert-ajax-msj">${msj}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>`);

    }
</script>