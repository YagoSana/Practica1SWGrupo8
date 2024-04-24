<?php
require '../../config.php';
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $venta_id = $_POST['venta_id'];
    $accion = $_POST['accion'];
    $valor = $_POST['valor'];

    // Obtener la venta
    $venta = Venta::getVentaById($venta_id);

    if ($accion == 'Aceptar') {
        // Cambiar el estado de la venta a "Aceptada"
        $venta->setEstado('Aceptada');

        // Crear un nuevo producto
        $producto = new Producto(null, $venta->Nombre, $venta->Descripcion, $valor, $venta->Imagen);
        $producto->createProducto();
    } else {
        // Cambiar el estado de la venta a "Rechazada"
        $venta->setEstado('Rechazada');
    }

    // Redirigir al usuario a la página de ventas
    header("Location: mostrarVentas.php");
    exit;
}
?>