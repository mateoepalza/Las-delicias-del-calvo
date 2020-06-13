<?php
$categoria = new Categoria();
$categorias = $categoria->buscarTodo();
?>

<link rel="stylesheet" href="Vista/static/css/cliente.css">

<div class="container mt-4">
    <div class="row">
        <div class="col-3 col-nav">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" data-id="0">Home</a>
                <?php
                foreach ($categorias as $cat) {
                ?>
                    <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="false" data-id="<?php echo $cat->getIdCategoria() ?>"><?php echo $cat->getNombre() ?></a>
                <?php
                }
                ?>
            </div>
        </div>
        <div id="pContainer" class="col-9">
            <div class="producto">
                <div class="producto-title">
                    <h1>Hamburguesa</h1>
                </div>
                <div class="producto-image" style="background-image: url('Vista/static/img/productos/ham.png');">

                </div>
                <div class="description">
                    <p>Hamburguesa</p>
                </div>
            </div>
            <div class="producto ">
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <div class="producto-image" style="background-image: url('Vista/static/img/productos/ham.png');">

                    </div>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="producto ">
                <div class="producto-image" style="background-image: url('Vista/static/img/productos/ham.png');">

                </div>
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example  make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="producto ">
                <div class="producto-image" style="background-image: url('Vista/static/img/productos/ham.png');">

                </div>
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="producto card">
                <div class="producto-image" style="background-image: url('Vista/static/img/productos/ham.png');">

                </div>
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="producto"></div>
            <div class="producto"></div>
            <div class="producto"></div>
            <div class="producto"></div>
            <div class="producto"></div>
            <div class="producto"></div>
            <div class="producto"></div>
            <div class="producto"></div>
            <div class="producto"></div>
            <div class="producto"></div>
            <div class="producto"></div>
        </div>
    </div>
</div>