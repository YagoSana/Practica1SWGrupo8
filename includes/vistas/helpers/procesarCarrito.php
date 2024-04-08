<?php
require '../../config.php';
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = $_POST['producto_id']; // Recupera el ID del producto enviado desde el cliente

    // Aquí asumimos que ya tienes una función para buscar un producto por su ID
    $producto = buscarProductoPorId($producto_id);

    // Accede al usuario y a su carrito desde la sesión
    $usuario = $_SESSION['usuario'];
    $carrito = $usuario->getCarrito();

    // Agrega el producto al carrito
    $carrito->agregarProducto($producto);

    echo "Producto agregado al carrito";
}
header('Location: '.RUTA_APP. '/includes/vistas/plantillas/paginaConfirmacion.php');
?>
