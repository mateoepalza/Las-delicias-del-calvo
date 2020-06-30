<?php
/**
 * Serializa un objeto carrito
 */
function createCarrito(){
    return serialize(new Carrito());
}
/**
 * deserializa el carrito 
 */
function dSerializeC(){
    return unserialize($_SESSION['carrito']);
}
/**
 * Envío del objeto carrito para que se pueda guardar en la variable de session de nuevo
 */
function serializeC($obj){
    $_SESSION['carrito'] = serialize($obj) ;
}
?>