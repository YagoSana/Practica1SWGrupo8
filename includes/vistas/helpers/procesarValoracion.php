<?php

require_once '../../config.php';
require_once '../../src/usuarios/usuario.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pedido_id = $_POST['pedido_id'];
    $producto_id = $_POST['producto_id']; 
    $valoracion = $_POST['valoracion']; 
    $comentario = $_POST['comentario']; 
    
    
    Usuario::valorarProducto($producto_id, $pedido_id, $_SESSION['usuario']->getId(), $valoracion, $comentario);
}
header('Location: ../plantillas/mostrarValoracion.php?id=' . $pedido_id);
exit;
?>