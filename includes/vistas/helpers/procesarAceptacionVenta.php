<?php
require '../../config.php';
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';
require_once "venta.php";

$ventaid = $_GET['venta'];

if ($ventaid > 0){
    $venta = Venta::getVentaById($ventaid);

    $puntos = intval($venta->getPrecio() * 0.1);
    Usuario::setWalletPoints($puntos, $venta->getIDUsuario());
    // Crear un nuevo producto
    // Al crear el producto hacemos que este no sea visible por los usuarios hasta que los empleados no quieran,
    // se establece la categoria, el stock se establece en 1 (por motivos obvios) y se establece como reacondicionado   
    $rutaImg = "/img/imagenesBD/" . $venta->getImagen();
    $nombre = $venta->getNombre();
    $descripcion = $venta->getDescripcion();
    $valor = $venta->getPrecio();
    $categoria = $venta->getCategoria();

    $producto = new Producto(null, $nombre, $descripcion, $valor, $rutaImg, 1, 1, $categoria, $venta->getIDUsuario());
    $producto->createProducto($nombre, $descripcion, $valor, $rutaImg, 1, 1, $categoria, $venta->getIDUsuario());
    $venta->setEstado('Aceptada');
}
else{
    $ventaid = -$ventaid;
    $venta = Venta::getVentaById($ventaid);
    $venta->setEstado('Rechazada');
}
header('Location: ' . RUTA_APP . '/includes/vistas/plantillas/mostrarGestionVentas.php');