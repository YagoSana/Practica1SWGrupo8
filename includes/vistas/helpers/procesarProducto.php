<?php
require_once '../../config.php';
require_once 'baseDatos.php';
require 'producto.php';

$db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);
$db->connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario
    $Nombre = $_POST['producto_nombre'];
    $Descripcion = $_POST['producto_descripcion'];
    $Precio = $_POST['producto_precio'];

    // Valida que el nombre tenga al menos 5 caracteres
    if (strlen($Nombre) < 5) {
        die('El nombre del producto debe tener al menos 5 caracteres.');
    }

    // Valida que el precio sea un número
    if (!is_numeric($Precio)) {
        die('El precio debe ser un número.');
    }

    // Obtén la imagen y su nombre
    $Imagen = $_FILES['producto_imagen']['name'];
    $ruta = $_FILES['producto_imagen']['tmp_name'];

    // Define la ruta donde se guardará la imagen en el servidor
    $target = "/img/imagenesBD/" . $Imagen;

    // Mueve la imagen a la carpeta de destino
    move_uploaded_file($ruta,RAIZ_APP."$target");

    // Usa la instancia de Database que ya creaste en baseDatos.php
    $connection = $db->getConnection();

    $producto = new Producto(null, $Nombre, $Descripcion, $Precio, $target);

    $producto->createProducto($Nombre, $Descripcion, $Precio, $target, $connection);
}

header('Location: ' . RUTA_APP . '/includes/vistas/plantillas/paginaConfirmacion.php');
?>