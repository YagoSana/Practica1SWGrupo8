<?php
require_once '../../config.php';
require_once '../plantillas/mostrarCarrito.php';
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';
require_once 'carrito.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['login'])) {
    $carrito = $_SESSION['usuario']->getCarrito();
    $carrito->confirmarPedido();
    header("Location: ". RUTA_APP ."/includes/vistas/plantillas/mostrarPedidos.php");
    exit;
} else {
    header("Location: ". RUTA_APP ."/includes/src/login.php");
    exit;
}
?>
