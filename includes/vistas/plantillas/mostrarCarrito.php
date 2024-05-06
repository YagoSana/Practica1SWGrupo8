<?php
require '../../config.php';
require_once RAIZ_APP . '/includes/src/usuarios/usuario.php';
require_once RAIZ_APP . '/includes/vistas/helpers/carrito.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include RAIZ_APP . '/includes/vistas/comun/header.php'; ?>
    <title>Carrito Back Music</title>
</head>

<body>
    <div id="contenedor">
        <?php include RAIZ_APP . '/includes/vistas/comun/cabecera.php'; ?>
        <?php include RAIZ_APP . '/includes/vistas/comun/lateralIzq.php'; ?>
        <main>
            <?php
            // Comprobamos que el usuario ha iniciado sesion
            if (isset($_SESSION['login'])) {
                // Obtiene el carrito de compras del usuario
                $carrito = $_SESSION['usuario']->getCarrito();

                // Muestra los productos en el carrito
                $productos_id = $carrito->getProductos();

                $total = 0;
                if ($productos_id == null) {
                    echo "El Carrito está vacío.";
                } else {
                    foreach ($productos_id as $producto_id) {
                        $producto = Producto::getProducto($producto_id['Producto']);
                        echo "<div class='producto'>";
                        echo "<img src='" . RUTA_APP . $producto->getImagen() . "' alt='Imagen del Producto'>";
                        echo "<div>";
                        echo "<h3>" . $producto->getNombre() . "</h3>";
                        echo "<p>Precio: " . $producto->getPrecio() . " €</p>";
                        $total += $producto->getPrecio() * $producto_id['Cantidad'];
                        if (isset($_SESSION["login"])) {
                            // El usuario ha iniciado sesión, muestra el botón "Eliminar"
                            echo '<div class="form-container">';
                            echo "<form action='" . RUTA_APP . "/includes/vistas/helpers/procesarProductoCarrito.php' method='post'>";
                            echo "<input type='hidden' name='productoId' value='" . $producto->getID() . "'>";
                            echo '<button type="submit" class="btn" name="accion" value="decrementar">-</button>';
                            echo '<span id="contador">' . $producto_id['Cantidad'] . '</span>';
                            echo '<button type="submit" class="btn" name="accion" value="incrementar">+</button>';
                            echo "<button class='borrar' type='submit' name='accion' value='eliminar'>Eliminar</button>";
                            echo "</form>";
                            echo "</div>";
                        }
                        echo "</div>";
                        echo "</div>";
                    }
                    if (isset($_SESSION["login"])) {
                        $totalSinDescuento = $total;
                        // El usuario ha iniciado sesión, muestra el botón "Confirmar Pedido"
                        echo "<div class='cont'>";
                        // Aquí es donde agregas 'data-total' al elemento que muestra el total
                        echo '<span class="total" data-total="' . $total . '">Total: ' . $total . ' €</span>';
                        echo '<form action="' . RUTA_APP . '/includes/vistas/helpers/procesarCompra.php?total=$total" method="POST">
                        <input type="hidden" name="total" value="' . $total . '">';
                        echo '<input type="hidden" name="totalSinDescuento" value="' . $totalSinDescuento . '">';
                        echo '<input type="checkbox" id="usarPuntos" name="usarPuntos" data-puntos="' . $puntos . '">';
                        echo '<label for="usarPuntos">¿Usar puntos del wallet?</label>
                        <input type="submit" name="confirmar" value="Confirmar Pedido" class="boton-confirmar">
                        </form>';
                        if (isset($_GET['error'])) {
                            echo "Error al procesar el pedido, no disponemos de tantos artículos en stock.";
                        }
                        echo '</div>';
                    }
                }
            } else {
                echo "<p>Debes iniciar sesión para ver tu carrito de compras.</p>";
            }
            ?>
        </main>
        <?php include RAIZ_APP . '/includes/vistas/comun/pieDePagina.php'; ?>
    </div>

    <script type="text/javascript" src="<?=RUTA_INCL?>/src/javaScript/restaPuntos.js"></script>
</body>

</html>