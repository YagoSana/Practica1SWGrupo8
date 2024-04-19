<?php
require_once '../../config.php';
header('Location: ' . RUTA_VISTAS . '/plantillas/mostrarCarrito.php');
require_once '../plantillas/compras.php';
require_once 'producto.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = $_POST['productoId']; 
    $accion = $_POST['accion'];
    
    $carrito = $_SESSION['usuario']->getCarrito();
    $cantidad = $carrito->getCantidadProducto($producto_id);
    
    if($accion == 'incrementar') {
        $carrito->comprobarProducto($producto_id);
    }
    elseif($cantidad > 1 && $accion == 'decrementar') {
        $carrito->restarCantidad($producto_id);
    } else {
        $carrito->eliminarProducto($producto_id);
    }
}