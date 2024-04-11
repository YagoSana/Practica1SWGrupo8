<?php
    require_once '../../config.php';
    //require_once 'Database.php';
    use es\ucm\fdi\sw\vistas\helpers\Database;
    //require 'Producto.php';
    use es\ucm\fdi\sw\vistas\helpers\Producto;

    if($_SERVER["REQUEST_METHOD"] == "POST"){ 

        // Recoge los datos del formulario
        $ID = $_POST['Producto_id'];

        $Producto = new Producto(null, null, null, null, null);
        $Producto->deleteProducto($ID);

    }

    header('Location: '.RUTA_APP. '/includes/vistas/plantillas/paginaConfirmacion.php');