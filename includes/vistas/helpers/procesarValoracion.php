<?php

require_once '../plantillas/mostrarValoracion.php';
require_once '../../config.php';
use es\ucm\fdi\sw\src\usuarios\usuario;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pedido_id = $_POST['pedido_id']; // Recupera el ID del producto enviado desde el cliente
    $valoracion = $_POST['valoracion']; // Recupera la valoración enviada desde el cliente
    $comentario = $_POST['comentario']; // Recupera el comentario enviado desde el cliente
    Usuario::valorarProducto($pedido_id, $_SESSION['usuario']->getId(), $valoracion, $comentario);
}

// Redirige al usuario a la página principal
header("Location: " . RUTA_APP . "/index.php");
exit;

?>
