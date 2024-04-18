<?php
// buscar.php
require_once ("../config.php");
include RAIZ_APP . '/includes/vistas/helpers/producto.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Asegúrate de que se ha enviado un término de búsqueda
if (!isset($_GET['q'])) {
    die("No se proporcionó ningún término de búsqueda.");
}

$busqueda = $_GET['q'];

// Aquí instancias tu clase Producto y obtienes todos los productos
$producto = new Producto(null, null, null, null, null);
$productos_data = $producto->getAllProductos();

// Filtra los productos que coinciden con la búsqueda
$resultados = array_filter($productos_data, function($producto) use ($busqueda) {
    return strpos($producto['Nombre'], $busqueda) !== false;
});

// Prepara el contenido para la plantilla
$contenido = '';
foreach ($resultados as $producto_data) {
    $producto = new Producto($producto_data['ID_Producto'], $producto_data['Nombre'], $producto_data['Descripcion'], $producto_data['Precio'], $producto_data['Imagen']);
    $contenido .= "<div class='producto'>";
    $contenido .= "<a class='subr' href='detalles_producto.php?id=" . $producto->getID() . "'>"; // Enlace a la página de detalles del producto
    $contenido .= "<img src='" . RUTA_APP . $producto->getImagen() . "' alt='Imagen del producto' id='imgCompras'>";
    $contenido .= "<div class ='detalles'>";
    $contenido .= "<h3>" . $producto->getNombre() . "</h3>";
    $contenido .= "</a>";//Solo la imagen y el nombre son clickeables
    $contenido .= "<p>" . $producto->getPrecio() . " €</p>";

    $contenido .= "<div class='botones'>";
    if (isset($_SESSION["login"])) {
        $contenido .= "<form action='" . RUTA_APP . "/includes/vistas/helpers/procesarCarrito.php' method='post'>"; //Procesa la adición al carro
        $contenido .= "<input type='hidden' name='producto_id' value='" . $producto->getID() . "'>";
        $contenido .= "<button class='agregar' type='submit' name='agregar_producto'>Agregar al carrito</button>";
        $contenido .= "</form>";
    } else {
        $contenido .= "<button class='agregar' onclick=\"window.location.href='" . RUTA_SRC . "/login.php'\">Agregar al carrito</button>";
    }

    if (isset($_SESSION["esEmpleado"])) {
        $contenido .= "<form action='" . RUTA_APP . "/includes/vistas/helpers/procesarEliminacion.php' method='post'>";
        $contenido .= "<input type='hidden' name='producto_id' value='" . $producto->getID() . "'>";
        $contenido .= "<button class='borrar' type='submit' name='eliminar_producto'>Eliminar</button>";
        $contenido .= "</form>";
    }

    $contenido .= "</div>";
    $contenido .= "</div>";
    $contenido .= "</div>";
}

// Incluye la plantilla
include RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
?>
