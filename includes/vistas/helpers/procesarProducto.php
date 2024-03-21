<?php
    require_once 'config.php';
    require 'baseDatos.php';
    require 'Producto.php';

    $db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);
    $db->connect(); 

    if($_SERVER["REQUEST_METHOD"] == "POST"){ 
        // Recoge los datos del formulario
        $ID = $_POST['producto_id'];
        $Nombre = $_POST['producto_nombre'];
        $Descripcion = $_POST['producto_descripcion'];
        $Precio = $_POST['producto_precio'];

        // Obtén la imagen y su nombre
        $Imagen = $_FILES['producto_imagen']['name'];
        $ruta = $_FILES['producto_imagen']['tmp_name'];

        // Define la ruta donde se guardará la imagen en el servidor
        $target = "../imagenes/".$Imagen;

        // Mueve la imagen a la carpeta de destino
        move_uploaded_file($ruta, $target);

        // Usa la instancia de Database que ya creaste en baseDatos.php
        $connection = $db->getConnection();

        $producto = new Producto(null, $Nombre, $Descripcion, $Precio, $target, $connection);

        $producto->createProducto($Nombre, $Descripcion, $Precio, $target);
    }

    header('Location: ../vistas/paginaConfirmacion.php');
?>
