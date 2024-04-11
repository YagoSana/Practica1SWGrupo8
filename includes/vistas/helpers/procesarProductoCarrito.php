<?php
require_once '../../config.php';
header('Location: ' . RUTA_VISTAS . '/plantillas/mostrarCarrito.php');
require_once '../plantillas/compras.php';
require_once 'baseDatos.php';
require_once 'producto.php';

$db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);
$db->connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = $_POST['productoId']; // Recupera el ID del producto enviado desde el cliente
    $accion = $_POST['accion'];
    // Accede al usuario y a su carrito desde la sesión
    $carrito = $_SESSION['usuario']->getCarrito();

    $stmt = $db->getConnection()->prepare('SELECT Cantidad FROM carrito WHERE Producto = :ID');
    $stmt->execute(['ID' => $producto_id]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    $cantidad = $resultado['Cantidad'];
    
    if($accion == 'incrementar') {
        $carrito->comprobarProducto($producto_id);
    }
    elseif($cantidad > 1 && $accion == 'decrementar') {
        $carrito->restarCantidad($producto_id);
    } else {
        $carrito->eliminarProducto($producto_id);
    }
}
?>