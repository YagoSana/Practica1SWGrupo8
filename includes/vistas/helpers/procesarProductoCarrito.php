<?php
require_once '../../config.php';
header('Location: ' . RUTA_VISTAS . '/plantillas/mostrarCarrito.php');
require_once '../plantillas/compras.php';
//require_once 'Database.php';
use es\ucm\fdi\sw\vistas\helpers\Database;
//require_once 'Producto.php';
use es\ucm\fdi\sw\vistas\helpers\Producto;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Producto_id = $_POST['ProductoId']; // Recupera el ID del Producto enviado desde el cliente
    $accion = $_POST['accion'];
    // Accede al Usuario y a su Carrito desde la sesión
    $Carrito = $_SESSION['usuario']->getCarrito();
    $cantidad = $Carrito->getCantidadProducto($Producto_id);
    
    if($accion == 'incrementar') {
        $Carrito->comprobarProducto($Producto_id);
    }
    elseif($cantidad > 1 && $accion == 'decrementar') {
        $Carrito->restarCantidad($Producto_id);
    } else {
        $Carrito->eliminarProducto($Producto_id);
    }
}