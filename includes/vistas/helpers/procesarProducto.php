<?php
require_once '../../config.php';
//require_once 'Database.php';
use es\ucm\fdi\sw\vistas\helpers\Database;
//require 'Producto.php';
use es\ucm\fdi\sw\vistas\helpers\Producto;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario
    $Nombre = $_POST['Producto_nombre'];
    $Descripcion = $_POST['Producto_descripcion'];
    $Precio = $_POST['Producto_precio'];

    // Valida que el nombre tenga al menos 5 caracteres
    if (strlen($Nombre) < 5) {
        die('El nombre del Producto debe tener al menos 5 caracteres.');
    }

    // Valida que el precio sea un número
    if (!is_numeric($Precio)) {
        die('El precio debe ser un número.');
    }

    // Obtén la imagen y su nombre
    $Imagen = $_FILES['Producto_imagen']['name'];
    $ruta = $_FILES['Producto_imagen']['tmp_name'];

    // Define la ruta donde se guardará la imagen en el servidor
    $target = "/img/imagenesBD/" . $Imagen;

    // Mueve la imagen a la carpeta de destino
    move_uploaded_file($ruta,RAIZ_APP."$target");

    $Producto = new Producto(null, $Nombre, $Descripcion, $Precio, $target);

    $Producto->createProducto($Nombre, $Descripcion, $Precio, $target);
}

header('Location: ' . RUTA_APP . '/includes/vistas/plantillas/paginaConfirmacion.php');