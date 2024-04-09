<?php
require '../../config.php';
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['login'])) {
    // Obtiene el carrito de compras del usuario
    $carrito = $_SESSION['usuario']->getCarrito();

    // Confirma el pedido
    $carrito->confirmarPedido();

    // Aquí puedes agregar el código para actualizar tu base de datos
    // Por ejemplo, podrías mover los productos del carrito a la tabla de pedidos,
    // y luego vaciar el carrito en la base de datos.

    // Redirige al usuario a una página de confirmación
    header("Location: confirmacionPedido.php");
    exit;
} else {
    // Si el usuario no ha iniciado sesión o si la solicitud no es POST,
    // redirige al usuario a la página de inicio de sesión.
    header("Location: login.php");
    exit;
}
?>
