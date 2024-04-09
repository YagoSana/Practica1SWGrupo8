<?php

require_once '../plantillas/mostrarCarrito.php';
require_once '../../config.php';
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';
require_once 'carrito.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['login'])) {
    // Obtiene el carrito de compras del usuario
    $carrito = $_SESSION['usuario']->getCarrito();

    // Confirma el pedido
    $carrito->confirmarPedido();

    // Aquí puedes agregar el código para actualizar tu base de datos
    // Por ejemplo, podrías mover los productos del carrito a la tabla de pedidos,
    // y luego vaciar el carrito en la base de datos.

    // Muestra un mensaje de confirmación
    echo "Tu pedido ha quedado registrado.";

    // Redirige al usuario a mostrarPedidos.php inmediatamente
    header("Location: ". RUTA_APP ."/includes/vistas/plantillas/mostrarPedidos.php");
    exit;
} else {
    // Si el usuario no ha iniciado sesión o si la solicitud no es POST,
    // redirige al usuario a la página de inicio de sesión.
    header("Location: ". RUTA_APP ."/includes/src/login.php");
    exit;
}
?>
