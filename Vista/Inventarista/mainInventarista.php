<?php 

$idInventarista = $_SESSION['id'];

$inventarista = new Inventarista($idInventarista);
$inventarista -> getInfoBasic();

?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <h1>Información Básica</h1>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-12 col-md-12 col-lg-11 col-xl-10">
            <div class="card">
                <div class="card-header bg-dark d-flex flex-row justify-content-center">
                    <h4 class="text-light">¡Bienvenido!</h4>
                </div>
                <div class="card-body">
                    <div class="row d-flex flex-row justify-content-center mb-4">
                        <div style="border-radius: 500px; overflow:hidden; width: 200px; height: 200px; background-image: url('<?php echo ($inventarista->getFoto() != "") ? $inventarista->getFoto() : "static/img/users/basic.png"; ?>'); background-repeat: no-repeat; background-position: center; background-size: cover;">
                        </div>
                    </div>
                    <div class="table-responsive-lg d-flex flex-row justify-content-center">
                        <table class="table" style="width: 80% !important">
                            <tbody id="tabla">
                                <tr>
                                    <th> Cargo</th>
                                    <td> Inventarista</td>
                                </tr>
                                <tr>
                                    <th> Nombre</th>
                                    <td> <?php echo $inventarista -> getNombre()?></td>
                                </tr>
                                <tr>
                                    <th> Apellido</th>
                                    <td> <?php echo $inventarista -> getApellido()?></td>
                                </tr>
                                <tr>
                                    <th> Email</th>
                                    <td> <?php echo $inventarista -> getCorreo()?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>