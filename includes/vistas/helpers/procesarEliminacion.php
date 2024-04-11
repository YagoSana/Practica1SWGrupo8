<?php
    require_once '../../config.php';
    use es\ucm\fdi\sw\vistas\helpers\producto;

    if($_SERVER["REQUEST_METHOD"] == "POST"){ 

        // Recoge los datos del formulario
        $ID = $_POST['producto_id'];

        $producto = new Producto(null, null, null, null, null);
        $producto->deleteProducto($ID);

    }

    header('Location: '.RUTA_APP. '/includes/vistas/plantillas/paginaConfirmacion.php');