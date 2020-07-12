<?php

$idLog = $_GET['idLog'];
$idTable = $_GET['idTable'];

if ($idTable == 1) {

    $log = new LogAdmin($idLog);
    $log->getInfoBasic();
    $user = new Administrador($log->getUser());
} else if ($idTable == 2) {

    $log = new LogCliente($idLog);
    $log->getInfoBasic();
    $user = new Cliente($log->getUser());
} else if ($idTable == 3) {

    $log = new LogInventarista($idLog);
    $log->getInfoBasic();
    $user = new Inventarista($log->getUser());
}

$user->getInfoBasic();

$accion = new Accion($log->getAccion());
$accion->getInfoBasic();

?>
<div class="row">
    <div class="col-12">
        <div class="row justify-content-center">
            <h1>Información de Usuario</h1>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-12">
                <div class="row d-flex flex-row justify-content-center mb-4">
                    <div style="border-radius: 500px; overflow:hidden; width: 200px; height: 200px; background-image: url('<?php echo ($user->getFoto() != "") ? $user->getFoto() : "static/img/users/basic.png"; ?>'); background-repeat: no-repeat; background-position: center; background-size: cover;">
                    </div>
                </div>
                <div class="table-responsive-lg d-flex flex-row justify-content-center">
                    <table class="table" style="width: 80% !important">
                        <tbody id="tabla">
                            <tr>
                                <th> Cargo</th>
                                <td> <?php echo (($log->getTipo() == 1) ? "Administrador" : (($log->getTipo() == 2) ? "Cliente" : "Inventarista")) ?></td>
                            </tr>
                            <tr>
                                <th> Nombre</th>
                                <td> <?php echo $user->getNombre() ?></td>
                            </tr>
                            <tr>
                                <th> Apellido</th>
                                <td> <?php echo $user->getApellido() ?></td>
                            </tr>
                            <tr>
                                <th> Email</th>
                                <td> <?php echo $user->getCorreo() ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="row justify-content-center">
            <h1>Información del Log</h1>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-12">
                <div class="table-responsive-lg">
                    <table class="table">
                        <tbody id="tabla">
                            <tr>
                                <th> Fecha y hora</th>
                                <td> <?php echo $log->getFecha() ?></td>
                            </tr>
                            <tr>
                                <th> Acción</th>
                                <td> <?php echo $accion->getNombre() ?></td>
                            </tr>
                            <tr>
                                <th> Información</th>
                                <td>
                                    <?php
                                    if ($log->getAccion() != 23) {
                                        if ($log->getInformacion() != "") {
                                            echo "<table >";
                                            $strList = explode(";;", $log->getInformacion());
                                            foreach ($strList as $str) {
                                                echo "<tr>";
                                                $strItem = explode(": ", $str);
                                                echo "<td style='border: 0px;'><b>" . $strItem[0] . "</b></td>";
                                                echo "<td style='border: 0px;'>" . $strItem[1] . "</td>";
                                                echo "<tr>";
                                            }
                                            echo "</table>";
                                        }
                                    } else {
                                        $strComplete = explode("%%", $log->getInformacion());

                                        $strList = explode(";;", $strComplete[0]);
                                        echo "<h5 style='margin: 20px 0px'>Información factura</h5>";
                                        echo "<table >";
                                        foreach ($strList as $str) {
                                            echo "<tr>";
                                            $strItem = explode(": ", $str);
                                            echo "<td><b>" . $strItem[0] . "</b></td>";
                                            echo "<td>" . $strItem[1] . "</td>";

                                            echo "<tr>";
                                        }
                                        echo "</table>";
                                        echo "<h5 style='margin: 20px 0px'>Productos</h5>";

                                        $stProductos = explode("&&", trim($strComplete[1], "&&"));

                                        echo "<table>";
                                        echo "<tr>";
                                        echo "<th>ID</th><th>Nombre</th><th>Precio</th><th>Cantidad</th>";
                                        echo "</tr>";
                                        foreach ($stProductos as $prod) {
                                            echo "<tr>";
                                            $strProd = explode(";;", $prod);
                                            foreach ($strProd as $item) {
                                                $items = explode(": ", $item);
                                                echo "<td>" . $items[1] . "</td>";
                                            }
                                            echo "</tr>";
                                        }
                                        echo "</table>";
                                    }

                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th> Navegador</th>
                                <td> <?php echo $log->getBrowser() ?></td>
                            </tr>
                            <tr>
                                <th> Sistema Operativo</th>
                                <td> <?php echo $log->getOs() ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>