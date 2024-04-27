<?php
    require_once '../../config.php';
    require 'producto.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){ 
        $eliminado = false;
        $ID = $_POST['producto_id'];
        
        $producto = new Producto(null, null, null, null, null, null,null, null, null);
        $eliminado = $producto->deleteProducto($ID);
        if($eliminado){
            header('Location: '.RUTA_APP. '/includes/vistas/plantillas/compras.php');
        }
    }

    