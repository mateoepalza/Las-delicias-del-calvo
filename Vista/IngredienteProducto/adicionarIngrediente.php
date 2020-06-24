<?php

$idProducto = $_GET['idProducto'];

$Ingrediente = new Ingrediente();
$listaIngredientes = $Ingrediente->buscarTodo();

$InPr = new IngredienteProducto($idProducto);
$listaProdIngredientes = $InPr->buscarIngredientes();

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <h1>Ingredientes</h1>
    </div>
    <div class="row justify-content-center mt-4 pb-5 border-bottom">
        <div class="col-4">
            <div>
                <label>Seleccione el ingrediente</label>
                <select id="select-ingrediente" class="form-control">
                    <option selected disabled>--Seleccione el ingrediente--</option>
                    <?php
                    foreach ($listaIngredientes as $item) {
                    ?>
                        <option value="<?php echo $item->getIdIngrediente() ?>"><?php echo $item->getNombre() ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-4">
            <div>
                <label>Ingrese la cantidad de unidades</label>
                <input type="number" min ="1" max="50" step="1" id="ingrediente-cantidad" class="form-control" placeholder="Cantidad">
            </div>
        </div>
        <div class="col-4 d-flex flex-column justify-content-end">
            <input type="hidden" id="idProductHidden" value="<?php echo $idProducto ?>">
            <button id="agregar-ingrediente" class="btn btn-primary">Agregar</button>
        </div>
    </div>
    <div class="row d-flex flex-row justify-content-center mt-5">
        <div id="ingredientes-container" class="col-10" style="display:flex; flex-flow: row wrap; justify-content: center ">
            <?php

            foreach ($listaProdIngredientes as $prod) {
            ?>
                <div class="card bg-light mb-3 m-3" style="max-width: 18rem;">
                    <div class="card-header d-flex flex-row justify-content-end"><span class="close-ingrediente" style="cursor:pointer;" data-idproducto="<?php echo $prod[0] ?>" data-idingrediente="<?php echo $prod[1] ?>">x</span></div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $prod[2] ?></h5>
                        <span class="card-text">Cantidad</span>
                        <input type="number" min ="1" max="50" step="1" class="form-control mt-3 mb-3" style="width:200px;" value="<?php echo $prod[3] ?>" placeholder="Cantidad">
                        <button class="btn-actualizar btn btn-info w-100" data-idproducto="<?php echo $prod[0] ?>" data-idingrediente="<?php echo $prod[1] ?>">Actualizar</button>
                    </div>
                </div>
            <?php
            }
            ?>


        </div>
    </div>
</div>
<!--<script src="static/js/bootstrap-input-spinner.js"></script>-->
<script type="text/javascript">
    $(function() {
        //$(".spinner").inputSpinner();
        /*
         * Evento de buscar en la tabla
         */

        $("#ingredientes-container").on('click', '.close-ingrediente', function() {
            let obj = $(this).parent().parent();
            json = {
                "idProducto": $(this).data("idproducto"),
                "idIngrediente": $(this).data("idingrediente")
            };
            console.log(json);
            $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/IngredienteProducto/Ajax/borrarIngrediente.php") ?>", json, function(data) {
                console.log(data);
                res = JSON.parse(data);
                
                if(res.msj){
                    eliminarIngredienteUI(obj);
                    crearAlert("alert-success", res.msj);
                }else{
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
            console.log(json);
            $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/IngredienteProducto/Ajax/agregarIngrediente.php") ?>", json, function(data) {
                
                res = JSON.parse(data);
                if(res.status){
                    crearIngredienteUI(res.data);
                    crearAlert("alert-success", res.msj);
                }else{
                    crearAlert("alert-danger", res.msj);
                }
                
            });
        });

        $("#ingredientes-container").on('click', ".btn-actualizar", function(){
            /*
             * Cojo el elemento de cantidad
             */
            let elem = $(this).siblings("input[type='number']");
            
            json = {
                "idProducto": $(this).data("idproducto"),
                "idIngrediente": $(this).data("idingrediente"),
                "cantidad": elem.val()
            };
            
            $.post("indexAJAX.php?pid=<?php echo base64_encode("Vista/IngredienteProducto/Ajax/actualizarIngrediente.php") ?>", json, function(data){
                res = JSON.parse(data);
                if(res.status){
                    crearAlert("alert-success", res.msj);
                }else{
                    crearAlert("alert-danger", res.msj);
                }
                
            });
        });

    });

    function eliminarIngredienteUI(elem) {
        elem.remove();
    }

    function crearIngredienteUI(data) {
        console.log(data);
        $(`<div class="card bg-light mb-3 m-3" style="max-width: 18rem;">
                <div class="card-header d-flex flex-row justify-content-end"><span class="close-ingrediente" style="cursor:pointer;" data-idproducto="${data[0]}" data-idingrediente="${data[1]}">x</span></div>
                <div class="card-body">
                    <h5 class="card-title">${data[2]}</h5>
                    <span class="card-text">Cantidad</span>
                    <input type="number" min ="1" max="50" step="1" class="form-control mt-3 mb-3" style="width:200px;" value="${data[3]}" placeholder="Cantidad">
                    <button class="btn-actualizar btn btn-info w-100" data-idproducto="${data[0]}" data-idingrediente="${data[1]}">Actualizar</button>
                </div>
            </div>`
        ).prependTo("#ingredientes-container");
    }

    function crearAlert(className, msj){

        $("#alert-ajax").html(`<div class="alert ${className} alert-dismissible fade show" role="alert" style="text-align: center; position: fixed; width: 100%;">
                        <span id="alert-ajax-msj">${msj}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>`
                    );

    }
</script>