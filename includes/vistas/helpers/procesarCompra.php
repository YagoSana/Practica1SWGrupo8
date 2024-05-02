<?php
require_once '../../config.php';
//header("Location: ". RUTA_APP ."/includes/vistas/plantillas/mostrarPedidos.php");
//require_once '../plantillas/mostrarCarrito.php';
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';
require_once 'carrito.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['login'])) {
    $carrito = $_SESSION['usuario']->getCarrito();
    $total = $_POST['total'];
    $exito = $carrito->confirmarPedido($total);
    if (!$exito) {
        $error = true;
        header ("Location: ". RUTA_APP ."/includes/vistas/plantillas/mostrarCarrito.php?error=$error");
    }
    else{
        header("Location: ". RUTA_APP ."/includes/vistas/plantillas/mostrarPedidos.php");
    }
} else {
    header("Location: ". RUTA_APP ."/includes/src/login.php");
}
?>
