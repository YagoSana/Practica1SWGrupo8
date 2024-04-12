<?php
require_once '../../config.php';
header("Location: ". RUTA_APP ."/includes/vistas/plantillas/mostrarPedidos.php");
require_once '../plantillas/mostrarCarrito.php';
use es\ucm\fdi\sw\src\usuarios\usuario;
use es\ucm\fdi\sw\vistas\helpers\carrito;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['login'])) {
    // Obtiene el carrito de compras del usuario
    $carrito = $_SESSION['usuario']->getCarrito();

    // Confirma el pedido
    $carrito->confirmarPedido();

    exit;
} else {
    // Si el usuario no ha iniciado sesión o si la solicitud no es POST,
    // redirige al usuario a la página de inicio de sesión.
    header("Location: ". RUTA_APP ."/includes/src/login.php");
    exit;
}
?>
