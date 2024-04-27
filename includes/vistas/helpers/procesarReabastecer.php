<?php
    require_once '../../config.php';
    require 'producto.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){ 
        $reabastecido = false;
        $ID = $_POST['producto_id'];
        
        $producto = new Producto(null, null, null, null, null, null,null, null, null);
        $producto_act = $producto->getProducto($ID);
        $reabastecido = $producto_act->reabastecerProducto();
        if($reabastecido){
            header('Location: '.RUTA_APP. '/includes/vistas/plantillas/compras.php');
        }
    }

    