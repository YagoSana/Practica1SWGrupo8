<?php
require '../../config.php';
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$titulo = 'Pedidos Back Music';
$contenido = "";
if (isset($_SESSION['login'])) {
    // Obtiene los pedidos del usuario
    $carrito = $_SESSION['usuario']->getCarrito();
    $pedido = $carrito->getPedido(); //Devuelve el pedido del usuario

    if($pedido == null) {
        $pedido = new Pedido($_SESSION['usuario']);
    }
        
    $contenido .= $pedido->mostrarPedidos();
    
} else {
    $contenido .= "<p>Debes iniciar sesión para ver tus pedidos.</p>";
}
require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';