<?php
require_once '../../config.php';
header("Location: " . RUTA_APP . "/includes/vistas/plantillas/compras.php");
require_once '../plantillas/compras.php';
require_once 'producto.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = $_POST['producto_id']; 
    $producto = new Producto(null, null, null, null, null);
    $producto_act = $producto->getProducto($producto_id);
    $carrito = $_SESSION['usuario']->getCarrito();
    $carrito->agregarProducto($producto_act);    
}
?>