<?php
require ("../../config.php");
require_once ("../helpers/producto.php");
require_once RAIZ_APP . '/includes/src/usuarios/usuario.php';
require_once ("../helpers/carrito.php");
$productos = [];

$producto = new Producto(null, null, null, null, null, null, null, null, null);
$productos_data = $producto->getAllProductos();

foreach ($productos_data as $producto_data) {
    $producto = new Producto($producto_data['ID_Producto'], $producto_data['Nombre'], $producto_data['Descripcion'], $producto_data['Precio'], $producto_data['Imagen'], $producto_data['Stock'], $producto_data['Visible'], $producto_data['Tipo'], $producto_data['ID_Venta']);
    $productos[] = $producto;
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$titulo = 'Compras Back Music';
$contenido = <<<EOS
    <article>
    <section>
        <h2>Compras Back Music</h2>
        <p>Esta el la sección de compras de Back Music. Aquí podrás encontrar todo lo que tenemos a la venta.</p>
    EOS;
    if (!empty($productos)) {
        // Itera sobre los productos y muestra la información
        foreach ($productos as $producto) {
            $visible = $producto->getVisible();
            if ($visible || isset($_SESSION["esEmpleado"])) {

                if($visible){
                    $class = "producto";
                } else $class = "producto productoOculto";

                $contenido .= "<div class='$class' style='position: relative;'>";
                //echo "<div class='producto'>";
                $contenido .= "<a class='subr' href='detalles_producto.php?id=" . $producto->getID() . "'>"; // Enlace a la página de detalles del producto

                $stock = $producto->getStock();
                $contenido .= "<span class='stock'>Stock: $stock</span>";

                $contenido .= "<img src='" . RUTA_APP . $producto->getImagen() . "' alt='Imagen del producto' id='imgCompras'>";
                $contenido .= "<div class ='detalles'>";
                $reacondicionado = "(Nuevo)";
                if($producto->esReacondicionado($producto)){ //revisa si el id de la venta es 0
                    $reacondicionado = "(Reacondicionado)";
                }
                $contenido .= "<h3>" . $producto->getNombre() ."</h3>";
                $contenido .= "<h4>" . $reacondicionado . "</h4>";
                $contenido .= "</a>";//Solo la imagen y el nombre son clickeables
                $contenido .= "<p>" . $producto->getPrecio() . " €</p>";
                $contenido .= "</div>";
                $contenido .= "<div class='botones'>";
                if (isset($_SESSION["login"])) {
                    $contenido .= "<form action='" . RUTA_APP . "/includes/vistas/helpers/procesarCarrito.php' method='post'>"; //Procesa la adición al carro
                    $contenido .= "<input type='hidden' name='producto_id' value='" . $producto->getID() . "'>";
                    $contenido .= "<button class='agregar' type='submit' name='agregar_producto'>Agregar al carrito</button>";
                    $contenido .= "</form>";
                } else {
                    $contenido .= "<button class='agregar' onclick=\"window.location.href='" . RUTA_SRC . "/login.php'\">Agregar al carrito</button>";
                }

                if (isset($_SESSION["esEmpleado"]) && $visible){
                    $contenido .= "<form action='" . RUTA_APP . "/includes/vistas/helpers/procesarEliminacion.php' method='post'>";
                    $contenido .= "<input type='hidden' name='producto_id' value='" . $producto->getID() . "'>";
                    $contenido .= "<button class='borrar' type='submit' name='eliminar_producto'>Ocultar</button>";
                    $contenido .= "</form>";
                }
                //si no es visible sea diferente
                else if (isset($_SESSION["esEmpleado"])) {
                    $contenido .= "<form action='" . RUTA_APP . "/includes/vistas/helpers/procesarReabastecer.php' method='post'>";
                    $contenido .= "<input type='hidden' name='producto_id' value='" . $producto->getID() . "'>";
                    $contenido .= "<button class='reabastecer' type='submit' name='reabastecer_producto'>Reabastecer</button>";
                    $contenido .= "</form>";
                }
                
                $contenido .= "</div>"; //fin div botones
                $contenido .= "</div>"; //fin div producto
            }
        }
    } else {
        $contenido .= "<p>No se encontraron productos</p>";
    }

    require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';