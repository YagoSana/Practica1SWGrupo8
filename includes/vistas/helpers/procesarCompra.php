<?php

require_once '../plantillas/mostrarCarrito.php';
require_once '../../config.php';
//require_once RAIZ_APP. '/includes/src/Usuarios/Usuario.php';
use es\ucm\fdi\sw\src\usuarios\Usuario;
//require_once 'Carrito.php';
use es\ucm\fdi\sw\vistas\helpers\Carrito;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['login'])) {
    // Obtiene el Carrito de compras del Usuario
    $Carrito = $_SESSION['usuario']->getCarrito();

    // Confirma el Pedido
    $Carrito->confirmarPedido();

    // Aquí puedes agregar el código para actualizar tu base de datos
    // Por ejemplo, podrías mover los Productos del Carrito a la tabla de Pedidos,
    // y luego vaciar el Carrito en la base de datos.

    // Muestra un mensaje de confirmación
    echo "Tu Pedido ha quedado registrado.";

    // Redirige al Usuario a mostrarPedidos.php inmediatamente
    header("Location: ". RUTA_APP ."/includes/vistas/plantillas/mostrarPedidos.php");
    exit;
} else {
    // Si el Usuario no ha iniciado sesión o si la solicitud no es POST,
    // redirige al Usuario a la página de inicio de sesión.
    header("Location: ". RUTA_APP ."/includes/src/login.php");
    exit;
}
?>
