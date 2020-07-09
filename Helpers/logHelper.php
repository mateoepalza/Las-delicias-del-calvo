<?php




function getOS()
{

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $plataformas = array(
        'Windows 10' => 'Windows NT 10.0+',
        'Windows 8.1' => 'Windows NT 6.3+',
        'Windows 8' => 'Windows NT 6.2+',
        'Windows 7' => 'Windows NT 6.1+',
        'Windows Vista' => 'Windows NT 6.0+',
        'Windows XP' => 'Windows NT 5.1+',
        'Windows 2003' => 'Windows NT 5.2+',
        'Windows' => 'Windows otros',
        'iPhone' => 'iPhone',
        'iPad' => 'iPad',
        'Mac OS X' => '(Mac OS X+)|(CFNetwork+)',
        'Mac otros' => 'Macintosh',
        'Android' => 'Android',
        'BlackBerry' => 'BlackBerry',
        'Linux' => 'Linux',
    );
    foreach ($plataformas as $plataforma => $pattern) {
        if (preg_match('/(?i)' . $pattern . '/', $user_agent))
            return $plataforma;
    }
    return 'Otras';
}



function getBrowser(){

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    if (strpos($user_agent, 'MSIE') !== FALSE)
        return 'Internet explorer';
    elseif (strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
        return 'Microsoft Edge';
    elseif (strpos($user_agent, 'Trident') !== FALSE) //IE 11
        return 'Internet explorer';
    elseif (strpos($user_agent, 'Opera Mini') !== FALSE)
        return "Opera Mini";
    elseif (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
        return "Opera";
    elseif (strpos($user_agent, 'Firefox') !== FALSE)
        return 'Mozilla Firefox';
    elseif (strpos($user_agent, 'Chrome') !== FALSE)
        return 'Google Chrome';
    elseif (strpos($user_agent, 'Safari') !== FALSE)
        return "Safari";
    else
        return 'Otro';
}

function LogHCrearProducto($nombre, $foto, $descripcion, $precio, $categoria){
    $str = "Nombre: " . $nombre .
        ";;Foto: " . $foto .
        ";;Descripción: " . $descripcion .
        ";;Precio: " . $precio .
        ";;Categoria: " . $categoria;

    return $str;
}

function LogHCrearIngrediente($nombre, $cantidad, $proveedor){
    $str = "Nombre: " . $nombre .
    ";;Cantidad: " . $cantidad .
    ";;Proveedor: " . $proveedor;
    return $str;
}

function LogHCrearCategoria($nombre){
    return "Nombre: ".$nombre;
}

function LogHCrearProveedor($nit, $nombre, $telefono, $direccion){
    $str = "NIT: ". $nit .
    ";;Nombre: " . $nombre .
    ";;Telefono: " . $telefono .
    ";;Dirección: " . $direccion;

    return $str;
}

function LogHCrearCliente($nombre, $apellido, $email, $clave, $estado){
    $str = "Nombre: " . $nombre .
    ";;Apellido: " . $apellido .
    ";;Email: " . $email .
    ";;Clave: " . md5($clave) .
    ";;Estado: " . $estado;

    return $str;
}

function LogHCrearInventarista($nombre, $apellido, $email, $clave, $estado){
    $str = "Nombre: " . $nombre .
    ";;Apellido: " . $apellido .
    ";;Email: " . $email .
    ";;Clave: " . md5($clave) .
    ";;Estado: " . $estado;

    return $str;
}

function LogHCrearIngredienteProducto($idProducto, $producto, $idIngrediente,  $ingrediente, $cantidad){
    $str = "idProducto: " . $idProducto .
    ";;Producto: " . $producto .
    ";;idIngrediente: " . $idIngrediente .
    ";;Ingrediente: " . $ingrediente . 
    ";;Cantidad:  " . $cantidad;

    return $str;
}