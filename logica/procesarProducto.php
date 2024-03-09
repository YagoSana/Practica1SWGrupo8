<?php
    require 'baseDatos.php';
    require 'Producto.php';

    $db = new Database('127.0.0.1', 'username', 'password', 'bd_def');
    $db->connect(); 

    if($_SERVER["REQUEST_METHOD"] == "POST"){ 
        // Comprueba si el campo 'ID' existe en el formulario enviado
        if (!isset($_POST['producto_id'])) {
            echo "El campo 'ID' es obligatorio.";
            exit;
        }

        // Recoge los datos del formulario
        $ID = $_POST['producto_id'];
        $Nombre = $_POST['producto_nombre'];
        $Descripcion = $_POST['producto_descripcion'];
        $Precio = $_POST['producto_precio'];

        // Usa la instancia de Database que ya creaste en baseDatos.php
        $connection = $db->getConnection();

        $producto = new Producto($ID, $Nombre, $Descripcion, $Precio, $connection);
        $producto->createProducto($ID, $Nombre, $Descripcion, $Precio);
    }

    header('Location: ../vistas/paginaConfirmacion.php');
?>

