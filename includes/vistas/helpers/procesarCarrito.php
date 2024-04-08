<?php
session_start(); // Inicia la sesión

require '../../config.php';
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';
require 'producto.php';
require 'baseDatos.php';

$db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);
$db->connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = $_POST['producto_id']; // Recupera el ID del producto enviado desde el cliente

    // Aquí asumimos que ya tienes una función para buscar un producto por su ID
    $producto = new Producto(null, null, null, null, null, $db->getConnection());
    $producto = $producto->getProducto($producto_id);

    // Accede al usuario y a su carrito desde la sesión


    $carrito = $_SESSION['usuario']->getCarrito();
    // Agrega el producto al carrito
    $carrito->agregarProducto($producto);

    echo "Producto agregado al carrito";
}
header('Location: '.RUTA_APP. '/includes/vistas/plantillas/paginaConfirmacion.php');
?>
