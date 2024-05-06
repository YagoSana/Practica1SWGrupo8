<?php
require_once '../../config.php';
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';
require_once 'carrito.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['login'])) {
    $carrito = $_SESSION['usuario']->getCarrito();
    $total = $_POST['total'];
    $totalSinDescuento = $_POST['totalSinDescuento'];
    $usarPuntos = isset($_POST['usarPuntos']);
    $puntos = Usuario::getPuntos($_SESSION['usuario']->getId());

    if ($usarPuntos) {
        if ($total > $puntos) {
            // Caso 1: El total es mayor que los puntos del wallet
            // Resta los puntos del wallet al total y elimina todos los puntos del wallet
            Usuario::quitarWalletPoints($puntos, $_SESSION['usuario']->getId());
        } else {
            // Caso 2: El total es menor o igual que los puntos del wallet
            // Resta el total de los puntos del wallet y establece el total a cero
            
            Usuario::quitarWalletPoints($totalSinDescuento, $_SESSION['usuario']->getId());
        }
    }
    else {
        $puntos += $totalSinDescuento * 0.05;

        Usuario::setWalletPoints($puntos, $_SESSION['usuario']->getId());
    }


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
