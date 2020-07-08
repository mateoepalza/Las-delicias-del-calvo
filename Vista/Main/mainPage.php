<?php 

if(isset($_POST['btn-registrar'])){

    $correo = $_POST['email'];
    $clave = $_POST['clave'];

    $cliente = new Cliente("", "", "", $correo, $clave);

    if($cliente -> existeCorreo()){

        $msj = "El correo proporcionado ya se encuentra en uso.";
        $class = "alert-danger";

    }else{

        $res = $cliente -> registrar();

        if($res == 1){
            $msj = "El registro fue exitoso, por favor revise su cuenta de correo para activar la cuenta.";
            $class = "alert-success";
        }else{
            $msj = "Ocurrió algo inesperado.";
            $class = "alert-danger";
        }
    }

    include "Vista/Main/error.php";

    
}

if(isset($_GET['activacion'])){

    $activacion = $_GET['activacion'];

    if($activacion == 1){
        $msj = "Su cuenta ha sido activada.";
        $class = "alert-success";
    }else{
        $msj = "Ocurrió algo inesperado.";
        $class = "alert-danger";
    }

    include "Vista/Main/error.php";
}
?>

<link rel="stylesheet" href="static/css/index.css">
<script type="text/javascript" src="static/js/index.js"></script>
<div class="hidden">
    <div class="form">
        <form action="index.php?pid=<?php echo base64_encode("Vista/Auth/autenticar.php") ?>" method="post">
            <div class="d-flex flex-row justify-content-center">
                <img src="static/img/logo.png" width=50>
            </div>
            <div>
                <h1>Log in</h1>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="email" type="email" placeholder="Type your email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control" name="pass" type="password" placeholder="Type your password">
            </div>
            <div class="form-group d-flex flex-column align-items-center">
                <input class="form-control btn btn-outline-secondary" name="btn-send" type="submit">
                <span class="mt-3">Don't have an account? <a href="#" id="registrarse">Sign In</a></span>
            </div>
        </form>
    </div>
</div>

<div class="hidden-registrar">
    <div class="form">
        <form action="index.php" method="POST">
            <div class="d-flex flex-row justify-content-center">
                <img src="static/img/logo.png" width=50>
            </div>
            <div>
                <h1>Sign In</h1>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="email" type="email" placeholder="Type your email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control" name="clave" type="password" placeholder="Type your password">
            </div>
            <div class="form-group d-flex flex-column align-items-center">
                <input class="form-control btn btn-outline-secondary" name="btn-registrar" type="submit">
                <span class="mt-3">Already have an account? <a href="#" id="Loguearse">Log In</a></span>
            </div>
        </form>
    </div>
</div>

<?php
if (isset($_GET['error'])) {
    $error = $_GET['error'];
    $msj = "";
    $class = "alert-danger";
    if ($error == 1) {
        $msj = "El correo y la contraseña no coinciden, intente denuevo.";
    } else if ($error == 2) {
        $msj = "Por favor revise su correo y active su cuenta";
        $class = "alert-warning";
    } else if ($error == 3) {
        $msj = "Su usuario ha sido inactivado, por favor contactese con el administrador";
    } else {
        $msj = "Ha ocurrido un error";
    }

    include "Vista/Main/error.php";
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="position: fixed; z-index:11; width: 100%">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="#"><img src="static/img/logo.png" width=50></a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <!--<li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>-->
        </ul>
        <div class="">
            <div id="signIn" class="btn btn-sm btn-outline-light">Log In</div>
        </div>
    </div>
</nav>

<div id="carouselExampleCaptions" class="carousel slide mb-5" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active" style="height: 600px; overflow: hidden">
            <div style="background : rgba(0,0,0,0.5); width : 100%; height : 100%; position: absolute">
            </div>
            <div class="w-100 h-100" style="background-Image: url('static/img/bg1.jpg'); background-position: center; background-repeat: no-repeat; background-size: cover"></div>
            <div class="carousel-caption d-none d-md-block">
                <h5>First slide label</h5>
                <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
            </div>
        </div>
        <div class="carousel-item" style="height: 600px; overflow: hidden">
            <div style="background : rgba(0,0,0,0.5); width : 100%; height : 100%; position: absolute">
            </div>
            <div class="w-100 h-100" style="background-Image: url('static/img/bg2.jpg'); background-position: center; background-repeat: no-repeat; background-size: cover"></div>
            <div class="carousel-caption d-none d-md-block">
                <h5>Second slide label</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>
        <div class="carousel-item" style="height: 600px; overflow: hidden">
            <div style="background : rgba(0,0,0,0.5); width : 100%; height : 100%; position: absolute">
            </div>
            <div class="w-100 h-100" style="background-Image: url('static/img/bg3.jpg'); background-position: center; background-repeat: no-repeat; background-size: cover"></div>
            <div class="carousel-caption d-none d-md-block">
                <h5>Third slide label</h5>
                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm-6  col-lg-4 mb-5 d-flex flex-column align-items-center justify-content-center">
            <div class="mb-4 d-flex flex-column justify-content-center align-items-end" style="width : 260px; height: 260px; border-radius: 200px; background: red; overflow: hidden; position: relative">
                <img src="static/img/bg3.jpg" height="100%" style="position: absolute">
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat ea alias excepturi praesentium iure odit provident dolorum, maiores qui reiciendis nesciunt, dignissimos ratione. Aliquid sapiente et atque fuga libero possimus.</p>
            <div class="d-flex flex-row justify-content-center">
                <a class="btn btn-outline-secondary" href="#"> View more</a>
            </div>
        </div>
        <div class="col-sm-6  col-lg-4 mb-5 d-flex flex-column align-items-center">

            <div class="mb-4 d-flex flex-column justify-content-center" style="width : 260px; height: 260px; border-radius: 200px; background: red; overflow: hidden; position: relative">
                <img src="static/img/bg2.jpg" height="100%" style="position: absolute">
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat ea alias excepturi praesentium iure odit provident dolorum, maiores qui reiciendis nesciunt, dignissimos ratione. Aliquid sapiente et atque fuga libero possimus.</p>
            <div class="d-flex flex-row justify-content-center">
                <a class="btn btn-outline-secondary" href="#"> View more</a>
            </div>
        </div>
        <div class="col-sm-6  col-lg-4 mb-5 d-flex flex-column align-items-center">

            <div class="mb-4 d-flex flex-column justify-content-center" style="width : 260px; height: 260px; border-radius: 200px; background: red; overflow: hidden; position: relative">
                <img src="static/img/bg1.jpg" height="100%" style="position: absolute">
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat ea alias excepturi praesentium iure odit provident dolorum, maiores qui reiciendis nesciunt, dignissimos ratione. Aliquid sapiente et atque fuga libero possimus.</p>
            <div class="d-flex flex-row justify-content-center">
                <a class="btn btn-outline-secondary" href="#"> View more</a>
            </div>
        </div>
        <div class="col-sm-6  col-lg-4 mb-5 d-flex flex-column align-items-center">
            <div class="mb-4 d-flex flex-column justify-content-center" style="width : 260px; height: 260px; border-radius: 200px; background: red; overflow: hidden; position: relative">
                <img src="static/img/bg3.jpg" height="100%" style="position: absolute">
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat ea alias excepturi praesentium iure odit provident dolorum, maiores qui reiciendis nesciunt, dignissimos ratione. Aliquid sapiente et atque fuga libero possimus.</p>
            <div class="d-flex flex-row justify-content-center">
                <a class="btn btn-outline-secondary" href="#"> View more</a>
            </div>
        </div>
        <div class="col-sm-6  col-lg-4 mb-5 d-flex flex-column align-items-center">

            <div class="mb-4 d-flex flex-column justify-content-center" style="width : 260px; height: 260px; border-radius: 200px; background: red; overflow: hidden; position: relative">
                <img src="static/img/bg2.jpg" height="100%" style="position: absolute">
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat ea alias excepturi praesentium iure odit provident dolorum, maiores qui reiciendis nesciunt, dignissimos ratione. Aliquid sapiente et atque fuga libero possimus.</p>
            <div class="d-flex flex-row justify-content-center">
                <a class="btn btn-outline-secondary" href="#"> View more</a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 mb-5 d-flex flex-column align-items-center">

            <div class="mb-4 d-flex flex-column justify-content-center" style="width : 260px; height: 260px; border-radius: 200px; background: red; overflow: hidden; position: relative">
                <img src="static/img/bg1.jpg" height="100%" style="position: absolute">
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat ea alias excepturi praesentium iure odit provident dolorum, maiores qui reiciendis nesciunt, dignissimos ratione. Aliquid sapiente et atque fuga libero possimus.</p>
            <div class="d-flex flex-row justify-content-center">
                <a class="btn btn-outline-secondary" href="#"> View more</a>
            </div>
        </div>
    </div>
</div>

<div class="footer" style="width: 100%; height: 75px; background-color: #343a40">

</div>