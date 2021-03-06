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

function LogHActualizarProducto($idProducto, $nombre, $url, $descripcion, $precio, $categoria){
    $str = "idProducto: ". $idProducto.
    ";;Nombre: " . $nombre .
    ";;Foto: " . $url .
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

function LogHActualizarIngrediente($idIngrediente, $nombre, $cantidad, $proveedor){
    $str = "idIngrediente: " . $idIngrediente .
    ";;Nombre: " . $nombre .
    ";;Cantidad: " . $cantidad .
    ";;Proveedor: " . $proveedor;
    return $str;
}

function LogHCrearCategoria($nombre){
    return "Nombre: " . $nombre;
}

function LogHActualizarCategoria($idCategoria, $nombre){
    return  "idCategoria: " . $idCategoria .
    ";;Nombre: " . $nombre;
}

function LogHCrearProveedor($nit, $nombre, $telefono, $direccion){
    $str = "NIT: ". $nit .
    ";;Nombre: " . $nombre .
    ";;Telefono: " . $telefono .
    ";;Dirección: " . $direccion;

    return $str;
}

function LogHActualizarProveedor($idProveedor, $nit, $nombre, $telefono, $direccion){
    $str = "idProveedor: " . $idProveedor .
    ";;NIT: ". $nit .
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
    ";;Estado: " . (($estado == 1)? "Activado" : (($estado == 0)? "Bloqueado" : "Desactivado"));

    return $str;
}

function LogHActualizarCliente($idCliente, $nombre, $apellido, $email, $clave, $estado){
    $str = "idCliente: " . $idCliente .
    ";;Nombre: " . $nombre .
    ";;Apellido: " . $apellido .
    ";;Email: " . $email .
    ";;Clave: " . (($clave != "") ?md5($clave) : "").
    ";;Estado: " . (($estado == 1)? "Activado" : (($estado == 0)? "Bloqueado" : "Desactivado"));

    return $str;
}

function LogHCrearInventarista($nombre, $apellido, $email, $clave, $estado){
    $str = "Nombre: " . $nombre .
    ";;Apellido: " . $apellido .
    ";;Email: " . $email .
    ";;Clave: " . md5($clave) .
    ";;Estado: " . (($estado == 1)? "Activado" :  "Bloqueado");

    return $str;
}

function LogHActualizarInventarista($idInventarista, $nombre, $apellido, $email, $clave, $estado){
    $str = "idInventarista: " . $idInventarista.
    ";;Nombre: " . $nombre .
    ";;Apellido: " . $apellido .
    ";;Email: " . $email .
    ";;Clave: " . (($clave != "") ?md5($clave) : "") .
    ";;Estado: " . (($estado == 1)? "Activado" :  "Bloqueado");

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

function LogHCambiarClave($nuevaClave){
    $str = "Clave: " . md5($nuevaClave);
    return $str;
}

function LogHActualizarInfoPersonal($idCliente, $nombre, $apellido, $email){

    $str = "idCliente: " . $idCliente .
    ";;Nombre: " . $nombre .
    ";;Apellido: " . $apellido .
    ";;Email: " . $email; 

    return $str;
}

function LogHActualizarEstadoCliente($idCliente, $nombre, $estado){
    $str = "idcliente: " . $idCliente .
    ";;Nombre: " . $nombre .
    ";;Estado: " .  (($estado == 1)? "Activado" : (($estado == 0)? "Bloqueado" : "Desactivado"));
    return $str;
}

function LogHActualizarEstadoInventarista($idInventarista, $nombre, $estado){
    $str = "idInventarista : " . $idInventarista .
    ";;Nombre: " . $nombre .
    ";;Estado: " .  (($estado == 1)? "Activado" : "Bloqueado");
    return $str;
}

function LogHActualizarAdministrador($idAdmin, $nombre, $apellido, $correo, $foto){
    $str = "idAdministrador: " . $idAdmin . 
    ";;Nombre: " . $nombre . 
    ";;Apellido: " . $apellido .
    ";;Correo: " . $correo . 
    ";;Foto: " . $foto ;

    return $str;
}

function LogHActualizarInventaristaIP($idInventarista, $nombre, $apellido, $correo, $foto){
    $str = "idInventarista: " . $idInventarista . 
    ";;Nombre: " . $nombre . 
    ";;Apellido: " . $apellido .
    ";;Correo: " . $correo . 
    ";;Foto: " . $foto ;

    return $str;
}

function LogHActualizarClienteIP($idCliente, $nombre, $apellido, $correo, $foto){
    $str = "idCliente: " . $idCliente . 
    ";;Nombre: " . $nombre . 
    ";;Apellido: " . $apellido .
    ";;Correo: " . $correo . 
    ";;Foto: " . $foto ;

    return $str;
}

function LogHCrearFactura($idFactura, $fecha, $valor, $cliente, $getListProducto){
    $str = "idFcatura: " . $idFactura . 
    ";;Fecha: " . $fecha .
    ";;Valor: " . $valor .
    ";;Cliente: " . $cliente .
    "%%";
    for($i = 0; $i < count($getListProducto); $i++){
        $str .= "idProducto: " . $getListProducto[$i][0] -> getIdProducto();
        $str .= ";;nombre: " . $getListProducto[$i][0] -> getNombre();
        $str .= ";;precio: " . $getListProducto[$i][0] -> getPrecio();
        $str .= ";;Cantidad: " . $getListProducto[$i][1];
        $str .= "&&";
    }
    return $str;
}

function LogHCrearAdministrador($nombre, $apellido, $correo, $clave){
    $str = "Nombre: " . $nombre . 
    ";;Apellido: " . $apellido .
    ";;Correo: " . $correo . 
    ";;Foto: " . md5($clave) ;

    return $str;
}