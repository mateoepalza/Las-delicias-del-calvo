<?php

$Categoria = new Categoria();
$resultados = $Categoria->buscarTodo();

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
                                echo "<td><a href='index.php?pid=" . base64_encode("Vista/Categoria/actualizarCategoria.php") . "&idCategoria=" . $resultado -> getIdCategoria() . "'><i class='far fa-edit'></i></a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <nav aria-label="...">
                        <ul id="pagination" class="pagination">
                            
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $("#search").on('keyup', function() {
            json = {
                "pid": "<?php echo base64_encode("Vista/Categoria/Ajax/searchBar.php") ?>",
                "search": $(this).val()
            };

            $.get("indexAJAX.php", json, function(data) {
                res = JSON.parse(data);
                $("#tabla").empty();

                res.DataT.forEach(function(data) {
                    $("#tabla").append("<tr><td>" + data[0] + "</td><td>" + data[1] + "</td><td><a href='index.php?pid=" + res.DataL + "&idCategoria=" + data[0] + "'><i class='far fa-edit'></i></a></td></tr>")
                });

                /*for(let i = 1; i >= res.DataP; i++){
                    if(i == res.Cpage){

                    }else{

                    }
                }
                <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>*/

            });
            /*$("#tabla").load('indexAJAX.php?pid=<?php echo base64_encode("Vista/Categoria/Ajax/searchBar.php") ?>&search='+$(this).val());
            $("#tabla").load('indexAJAX.php?pid=<?php echo base64_encode("Vista/Categoria/Ajax/pagination.php") ?>&search='+$(this).val());*/

        });
    });
</script>