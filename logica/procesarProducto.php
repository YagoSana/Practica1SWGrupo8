<?php
    require 'baseDatos.php';
    require 'Producto.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){ //Comprueba si se ha enviado el formulario correctamente
        //Recoge los datos del formulario
        $Nombre = $_POST['producto_nombre'];
        $Descripcion = $_POST['producto_descripcion'];
        $Precio = $_POST['producto_precio'];

        $producto = new Producto($Nombre, $Descripcion, $Precio, $pdo);
        $producto->createProducto($Nombre, $Descripcion, $Precio);
    }  
?>
