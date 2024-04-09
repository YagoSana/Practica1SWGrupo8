<?php
require_once '../plantillas/compras.php';
require_once '../../config.php';
require_once 'baseDatos.php';
require_once 'producto.php';

$db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);
$db->connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = $_POST['producto_id']; // Recupera el ID del producto enviado desde el cliente
    // Aquí asumimos que ya tienes una función para buscar un producto por su ID
    $connection = $db->getConnection();

    $producto = new Producto(null, null, null, null, null);
    $producto_act = $producto->getProducto($producto_id, $connection);
    //var_dump($_SESSION['usuario']);
    // Accede al usuario y a su carrito desde la 
    $carrito = $_SESSION['usuario']->getCarrito();
    // Agrega el producto al carrito
    $carrito->agregarProducto($producto_act);
   
    echo "Producto agregado al carrito";
}