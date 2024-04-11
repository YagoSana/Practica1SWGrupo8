<?php

require_once '../plantillas/mostrarValoracion.php';
require_once '../../config.php';
//require_once RAIZ_APP. '/includes/src/Usuarios/Usuario.php';
use es\ucm\fdi\sw\src\usuarios\Usuario;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Producto_id = $_POST['Producto_id']; // Recupera el ID del Producto enviado desde el cliente
    $Valoracion = $_POST['Valoracion']; // Recupera la valoración enviada desde el cliente
    $comentario = $_POST['comentario']; // Recupera el comentario enviado desde el cliente
    Usuario::valorarProducto($Producto_id, $_SESSION['Usuario']->getId(), $Valoracion, $comentario);
}

// Redirige al Usuario a la página principal
header("Location: " . RUTA_APP . "/index.php");
exit;

?>
