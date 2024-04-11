<?php

require_once '../plantillas/mostrarValoracion.php';
require_once '../../config.php';
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = $_POST['producto_id']; // Recupera el ID del producto enviado desde el cliente
    $valoracion = $_POST['valoracion']; // Recupera la valoración enviada desde el cliente
    $comentario = $_POST['comentario']; // Recupera el comentario enviado desde el cliente
    usuario::valorarProducto($producto_id, $_SESSION['usuario']->getId(), $valoracion, $comentario);
}

// Redirige al usuario a la página principal
header("Location: " . RUTA_APP . "/index.php");
exit;

?>
