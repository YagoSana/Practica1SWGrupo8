<?php
require '../../config.php';
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';
require_once "venta.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $venta_id = $_POST['venta_id'];
    $accion = $_POST['accion'];
    $valor = $_POST['valor'];
    $categoria = $_POST['categoria'];

    // Obtener la venta
    $venta = Venta::getVentaById($venta_id);

    if ($accion == 'Aceptar') {
        // Cambiar el estado de la venta a "Aceptada"
        $venta->setEstado('Aceptada');

        // Crear un nuevo producto
        // Al crear el producto hacemos que este no sea visible por los usuarios hasta que los empleados no quieran,
        // se establece la categoria, el stock se establece en 1 (por motivos obvios) y se establece como reacondicionado   
        $rutaImg = "/img/imagenesBD/" . $venta->getImagen();

        $producto = new Producto(null, $venta->getNombre(), $venta->getDescripcion(), $valor, $rutaImg, 1, 1, $categoria, $venta->getIDUsuario());
        $producto->createProducto($venta->getNombre(), $venta->getDescripcion(), $valor, $rutaImg, 1, 1, $categoria, $venta->getIDUsuario());
    } else {
        // Cambiar el estado de la venta a "Rechazada"
        $venta->setEstado('Rechazada');
    }

    // Redirigir al usuario a la página de ventas
    header('Location: ' . RUTA_APP . '/includes/vistas/plantillas/mostrarVentas.php');
    exit;
}
?>