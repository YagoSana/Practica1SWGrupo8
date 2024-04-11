<?php
require_once '../../config.php';
header("Location: " . RUTA_APP . "/includes/vistas/plantillas/compras.php");
require_once '../plantillas/compras.php';
//require_once 'Database.php';
use es\ucm\fdi\sw\vistas\helpers\Database;
//require_once 'Producto.php';
use es\ucm\fdi\sw\vistas\helpers\Producto;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Producto_id = $_POST['Producto_id']; // Recupera el ID del Producto enviado desde el cliente

    $Producto = new Producto(null, null, null, null, null);
    $Producto_act = $Producto->getProducto($Producto_id);
    //var_dump($_SESSION['Usuario']);
    // Accede al Usuario y a su Carrito desde la 
    $Carrito = $_SESSION['usuario']->getCarrito();
    // Agrega el Producto al Carrito
    $Carrito->agregarProducto($Producto_act);
   
    
}