<?php
require_once '../../config.php';
header("Location: " . RUTA_APP . "/index.php");
require_once '../plantillas/mostrarValoracion.php';

require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pedido_id = $_POST['pedido_id']; 
    $valoracion = $_POST['valoracion']; 
    $comentario = $_POST['comentario']; 
    Usuario::valorarProducto($pedido_id, $_SESSION['usuario']->getId(), $valoracion, $comentario);
}


exit;