<?php

$pagina = 1;
$numReg = 5;

$Categoria = new Categoria();
$resultados = $Categoria->buscarPaginado($pagina, $numReg);
$cantPag = $Categoria->buscarCantidad();
$pagination = $cantPag / $numReg;
echo $pagination;
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Ingrese una nueva categoria
                    <input id="search" type="search" placeholder="search">
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tabla">
                            <?php
                            foreach ($resultados as $resultado) {
                                echo "<tr>";
                                echo "<td>" . $resultado->getIdCategoria() . "</td>";
                                echo "<td>" . $resultado->getNombre() . "</td>";
                                echo "<td><a href='index.php?pid=" . base64_encode("Vista/Categoria/actualizarCategoria.php") . "&idCategoria=" . $resultado->getIdCategoria() . "'><i class='far fa-edit'></i></a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex flex-row justify-content-center ">
                    <nav aria-label="...">
                        <ul class="pagination">
                            <li class="page-item page-item-list disabled" id="page-previous" data-page="<?php echo ($pagina - 1)?>">
                                <span class="page-link">Previous</span>
                            </li>
                            <?php
                            for ($i = 0; $i <= $pagination; $i++) {
                            ?>
                                <li class="page-item page-item-list page-numbers <?php echo (($i+1) == $pagina)? "active" : ""; ?>" data-page="<?php echo ($i + 1);?>"><a class="page-link" href="#" ><?php echo ($i + 1); ?></a></li>
                            <?php
                            }
                            ?>
                            <li class="page-item page-item-list" id="page-next" data-page="<?php echo ($pagina + 1)?>">
                                <a  class="page-link" href="#">Next</a>
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
                "pid": "<?php echo base64_encode("Vista/Categoria/Ajax/searchBar.php") ?>",
                "page": "1",
                "search": $(this).val()
            };

            $.get("indexAJAX.php", json, function(data) {
                res = JSON.parse(data);
                console.log(res);
                // Imprime los datos de la tabla
                tablePrint(res.DataT);
                //Imprime la paginación
                paginationPrint(res.DataP, parseInt(res.Cpage));

            });
        });

        /*
         * Evento de cambiar de página
         */
        
        $(".pagination").on('click', ".page-item-list", function(){
            alert($(this).data("page"));
            json = {
                "pid": "<?php echo base64_encode("Vista/Categoria/Ajax/searchBar.php") ?>",
                "page": $(this).data("page"),
                "search": $("#search").val()
            };

            $.get("indexAJAX.php", json, function(data) {
                console.log(data);
                res = JSON.parse(data);
                console.log(res);
                //imprime los datos en la tabla
                tablePrint(res.DataT);
                //Imprime paginación
                paginationPrint(res.DataP, parseInt(res.Cpage));
            });
        })

    });

    /*
     * Imprime los datos en la tabla
     */
    function tablePrint(DataT) {
        $("#tabla").empty();

        DataT.forEach(function(data) {
            $("#tabla").append("<tr><td>" + data[0] + "</td><td>" + data[1] + "</td><td><a href='index.php?pid=" + res.DataL + "&idCategoria=" + data[0] + "'><i class='far fa-edit'></i></a></td></tr>")
        });
    }
    /*
     * Imprime la paginación de la tabla
     */
    function paginationPrint(cantPag, actualPage){
        $(".page-numbers").remove();
        updateBefore(actualPage-1);
        console.log("aca : "+cantPag)
        updateNext(actualPage+1, Math.ceil(cantPag));
        for(let i = 0; i <= cantPag; i++){
            if((i+1) == actualPage){
                $("#page-next").before("<li class='page-item page-item-list page-numbers active' data-page='" + (i+1) + "'><a class='page-link' href='#'>" + (i+1) + "</a></li>")
            }else{
                $("#page-next").before("<li class='page-item page-item-list page-numbers' data-page='" + (i+1) + "'><a class='page-link' href='#'>" + (i+1) + "</a></li>");
            }
            
        }
    }

    /*
     * Actualiza los botones anterior y siguiente
     */
    function updateBefore(previousNumber){
        if(previousNumber <= 0){
            $("#page-previous").addClass("disabled");
            $("#page-previous").data("page", 0); 
        }else{
            $("#page-previous").removeClass("disabled");
            $("#page-previous").data("page", previousNumber); 
        }
        
    }

    function updateNext(nextNumber, cantPag){
        console.log(nextNumber);
        console.log(cantPag);
        if(nextNumber > cantPag){
            $("#page-next").addClass("disabled");
            $("#page-next").data("page", cantPag); 
            
        }else{
            $("#page-next").data("page", nextNumber); 
            $("#page-next").removeClass("disabled");
        }
        
    }
</script>