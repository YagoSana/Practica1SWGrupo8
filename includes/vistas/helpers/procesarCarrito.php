<?php
require_once '../../config.php';
header("Location: " . RUTA_APP . "/includes/vistas/plantillas/compras.php");
require_once '../plantillas/compras.php';
use es\ucm\fdi\sw\vistas\helpers\producto;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = $_POST['producto_id']; // Recupera el ID del producto enviado desde el cliente

    $producto = new Producto(null, null, null, null, null);
    $producto_act = $producto->getProducto($producto_id);
    // Accede al usuario y a su carrito desde la 
    $carrito = $_SESSION['usuario']->getCarrito();
    // Agrega el producto al carrito
    $carrito->agregarProducto($producto_act);
   
    
}
?>