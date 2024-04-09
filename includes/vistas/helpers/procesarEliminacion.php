<?php
    require_once '../../config.php';
    require_once 'baseDatos.php';
    require 'producto.php';

    $db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);
    $db->connect(); 

    if($_SERVER["REQUEST_METHOD"] == "POST"){ 

        // Recoge los datos del formulario
        $ID = $_POST['producto_id'];

        // Usa la instancia de Database que ya creaste en baseDatos.php
        $connection = $db->getConnection();

        $producto = new Producto(null, null, null, null, null);
        $producto->deleteProducto($ID, $connection);

    }

    header('Location: '.RUTA_APP. '/includes/vistas/plantillas/paginaConfirmacion.php');
?>