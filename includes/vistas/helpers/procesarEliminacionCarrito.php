<?php
require_once '../plantillas/compras.php';
require_once '../../config.php';
require_once 'baseDatos.php';
require_once 'producto.php';

$db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);
$db->connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = $_POST['productoId']; // Recupera el ID del producto enviado desde el cliente

    // Accede al usuario y a su carrito desde la sesión
    $carrito = $_SESSION['usuario']->getCarrito();

    // Elimina el producto del carrito
    $carrito->eliminarProducto($producto_id, $db);

    echo "Producto eliminado del carrito";
}