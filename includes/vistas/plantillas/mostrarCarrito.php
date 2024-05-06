<?php
require '../../config.php';
require_once RAIZ_APP . '/includes/src/usuarios/usuario.php';
require_once RAIZ_APP . '/includes/vistas/helpers/carrito.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$titulo = 'Carrito Back Music';
$contenido = '';
$javascript = "/src/javaScript/restaPuntos.js";

// Comprobamos que el usuario ha iniciado sesion
if (isset($_SESSION['login'])) {
    // Obtiene el carrito de compras del usuario
    $carrito = $_SESSION['usuario']->getCarrito();
    $puntos = Usuario::getPuntos($_SESSION['usuario']->getId());
    // Muestra los productos en el carrito
    $productos_id = $carrito->getProductos();

    $total = 0;
    if ($productos_id == null) {
        $contenido .= "El Carrito está vacío.";
    } else {
        foreach ($productos_id as $producto_id) {
            $producto = Producto::getProducto($producto_id['Producto']);
            $contenido .= "<div class='producto'>";
            $contenido .= "<img src='" . RUTA_APP . $producto->getImagen() . "' alt='Imagen del Producto'>";
            $contenido .= "<div>";
            $contenido .= "<h3>" . $producto->getNombre() . "</h3>";
            $contenido .= "<p>Precio: " . $producto->getPrecio() . " €</p>";
            $total += $producto->getPrecio() * $producto_id['Cantidad'];
            if (isset($_SESSION["login"])) {
                // El usuario ha iniciado sesión, muestra el botón "Eliminar"
                $contenido .= '<div class="form-container">';
                $contenido .= "<form action='" . RUTA_APP . "/includes/vistas/helpers/procesarProductoCarrito.php' method='post'>";
                $contenido .= "<input type='hidden' name='productoId' value='" . $producto->getID() . "'>";
                $contenido .= '<button type="submit" class="btn" name="accion" value="decrementar">-</button>';
                $contenido .= '<span id="contador">' . $producto_id['Cantidad'] . '</span>';
                $contenido .= '<button type="submit" class="btn" name="accion" value="incrementar">+</button>';
                $contenido .= "<button class='borrar' type='submit' name='accion' value='eliminar'>Eliminar</button>";
                $contenido .= "</form>";
                $contenido .= "</div>";
            }
            $contenido .= "</div>";
            $contenido .= "</div>";
        }
        if (isset($_SESSION["login"])) {
            $totalSinDescuento = $total;
            // El usuario ha iniciado sesión, muestra el botón "Confirmar Pedido"
            $contenido .= "<div class='cont'>";
            // Aquí es donde agregas 'data-total' al elemento que muestra el total
            $contenido .= '<span class="total" data-total="' . $total . '">Total: ' . $total . ' €</span>';
            $contenido .= '<form action="' . RUTA_APP . '/includes/vistas/helpers/procesarCompra.php?total=$total" method="POST">
            <input type="hidden" name="total" value="' . $total . '">';
            $contenido .= '<input type="hidden" name="totalSinDescuento" value="' . $totalSinDescuento . '">';
            if ($puntos > 0) {
                $contenido .= '<input type="checkbox" id="usarPuntos" name="usarPuntos" data-puntos="' . $puntos . '">';
                $contenido .= '<label for="usarPuntos">¿Usar puntos del wallet?</label>';
            } else {
                $contenido .= '<p>No tienes puntos en tu wallet para utilizar.</p>';
            }
            $contenido .= '<input type="submit" name="confirmar" value="Confirmar Pedido" class="boton-confirmar">
            </form>';
            if (isset($_GET['error'])) {
                $contenido .= "Error al procesar el pedido, no disponemos de tantos artículos en stock.";
            }
            $contenido .= '</div>';
        }
    }
} else {
    $contenido .= "<p>Debes iniciar sesión para ver tu carrito de compras.</p>";
}

require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
?>
