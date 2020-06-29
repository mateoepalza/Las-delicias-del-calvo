<?php

$categoria = new Categoria();

$resultados = $categoria->buscarTodo();

$Ingrediente = new Ingrediente();
$listaIngredientes = $Ingrediente->buscarTodo();


?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <form action="index.php?pid=<?php echo base64_encode("Vista/Producto/crearProducto.php") ?>" method="POST" enctype="multipart/form-data">
                <div class="row d-flex flex-row justify-content-center mt-5 mb-5">
                    <h1>Ingrese un producto</h1>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" name="nombre" type="text" required>
                        </div>
                        <div class="form-group">
                            <label>Categoria</label>
                            <select class="form-control" name="categoria" required>
                                <option selected value="" disabled>- Seleccione -</option>
                                <?php
                                foreach ($resultados as $res) {
                                    echo "<option value=" . $res->getIdCategoria() . ">" . $res->getNombre() . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>descripción</label>
                            <textarea class="form-control" name="descripcion" id="" cols="30" rows="10" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Precio</label>
                            <input class="form-control" name="precio" type="number" required>
                        </div>
                        <div class="form-group">
                            <label>Imagen</label>
                            <input class="form-control" style="border:0px;" name="archivo" type="file">
                        </div>

                    </div>
                    <div class="col-7">
                        <div class="row justify-content-center mt-4">
                            <div class="col-4 d-flex flex-column justify-content-between">

                                <label>Seleccione el ingrediente</label>
                                <select id="select-ingrediente" class="form-control">
                                    <option selected disabled>--Ingrediente--</option>
                                    <?php
                                    foreach ($listaIngredientes as $item) {
                                    ?>
                                        <option value="<?php echo $item->getIdIngrediente() ?>"><?php echo $item->getNombre() ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>

                            </div>
                            <div class="col-4 d-flex flex-column justify-content-between">

                                <label>Ingrese la cantidad de unidades</label>
                                <input type="number" min="1" max="50" step="1" id="ingrediente-cantidad" class="form-control" placeholder="Cantidad">

                            </div>
                        </div>
                        <div class="row d-flex flex-row justify-content-center mt-4 pb-5 border-bottom">
                            <div class="col-8">
                                <input type="hidden" id="idProductHidden" value="<?php echo $idProducto ?>">
                                <button id="agregar-ingrediente" class="btn btn-primary w-100">Agregar</button>
                            </div>
                        </div>
                        <div class="row d-flex flex-row justify-content-center mt-5">
                            <div id="ingredientes-container" class="col-10" style="display:flex; flex-flow: row wrap; justify-content: center ">

                                <div class="jumbotron bg-light mb-3 m-3" style="position:relative">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5>Queso doble cremaaa</h5>
                                        </div>
                                        <div class="col-6">
                                            <span class="">Cantidad</span>
                                            <input type="number" min="1" max="50" step="1" class="form-control mt-3 mb-3" style="width:200px;"  placeholder="Cantidad">
                                        </div>
                                    </div>
                                    <div style="position:absolute; right: 15px; top: 15px">
                                            <span class="close-ingrediente" style="cursor:pointer;">x</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex flex-row justify-content-center mt-5">
                    <div class="col-8">
                        <div class="form-group">
                            <input class="form-control btn btn-primary" name="sent" type="submit">
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>



<!--<script src="static/js/bootstrap-input-spinner.js"></script>-->
<script type="text/javascript">
    $(function() {

        $("#ingredientes-container").on('click', '.close-ingrediente', function() {
            let obj = $(this).parent().parent();
            json = {
                "idProducto": $(this).data("idproducto"),
                "idIngrediente": $(this).data("idingrediente")
            };
            
            $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/IngredienteProducto/Ajax/borrarIngrediente.php") ?>", json, function(data) {
                
                res = JSON.parse(data);

                if (res.msj) {
                    eliminarIngredienteUI(obj);
                    crearAlert("alert-success", res.msj);
                } else {
                    crearAlert("alert-danger", res.msj);
                }

            });
        });

        $("#agregar-ingrediente").on('click', function() {
            json = {
                "idProducto": $("#idProductHidden").val(),
                "idIngrediente": $("#select-ingrediente").val(),
                "cantidad": $("#ingrediente-cantidad").val()
            };
            
            $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/IngredienteProducto/Ajax/agregarIngrediente.php") ?>", json, function(data) {

                res = JSON.parse(data);
                if (res.status) {
                    crearIngredienteUI(res.data);
                    crearAlert("alert-success", res.msj);
                } else {
                    crearAlert("alert-danger", res.msj);
                }

            });
        });

        $("#ingredientes-container").on('click', ".btn-actualizar", function() {
            /*
             * Cojo el elemento de cantidad
             */
            let elem = $(this).siblings("input[type='number']");

            json = {
                "idProducto": $(this).data("idproducto"),
                "idIngrediente": $(this).data("idingrediente"),
                "cantidad": elem.val()
            };

            $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/IngredienteProducto/Ajax/actualizarIngrediente.php") ?>", json, function(data) {
                res = JSON.parse(data);
                if (res.status) {
                    crearAlert("alert-success", res.msj);
                } else {
                    crearAlert("alert-danger", res.msj);
                }

            });
        });

    });

    function eliminarIngredienteUI(elem) {
        elem.remove();
    }

    function crearIngredienteUI(data) {
        
        $(`<div class="card bg-light mb-3 m-3" style="max-width: 18rem;">
                <div class="card-header d-flex flex-row justify-content-end"><span class="close-ingrediente" style="cursor:pointer;" data-idproducto="${data[0]}" data-idingrediente="${data[1]}">x</span></div>
                <div class="card-body">
                    <h5 class="card-title">${data[2]}</h5>
                    <span class="card-text">Cantidad</span>
                    <input type="number" min ="1" max="50" step="1" class="form-control mt-3 mb-3" style="width:200px;" value="${data[3]}" placeholder="Cantidad">
                    <button class="btn-actualizar btn btn-info w-100" data-idproducto="${data[0]}" data-idingrediente="${data[1]}">Actualizar</button>
                </div>
            </div>`).prependTo("#ingredientes-container");
    }

    function crearAlert(className, msj) {

        $("#alert-ajax").html(`<div class="alert ${className} alert-dismissible fade show" role="alert" style="text-align: center; position: fixed; width: 100%;">
                        <span id="alert-ajax-msj">${msj}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>`);

    }
</script>