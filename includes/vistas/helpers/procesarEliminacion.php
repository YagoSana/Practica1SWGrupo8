<?php
    require_once '../../config.php';
    require 'producto.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){ 

        $ID = $_POST['producto_id'];

        $producto = new Producto(null, null, null, null, null);
        $producto->deleteProducto($ID);

    }

    header('Location: '.RUTA_APP. '/includes/vistas/plantillas/paginaConfirmacion.php');