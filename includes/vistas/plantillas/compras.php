<?php
require ("../../config.php");
require_once ("../helpers/producto.php");
require_once RAIZ_APP . '/includes/src/usuarios/usuario.php';
require_once ("../helpers/carrito.php");
$productos = [];

$producto = new Producto(null, null, null, null, null);
$productos_data = $producto->getAllProductos();

foreach ($productos_data as $producto_data) {
    $producto = new Producto($producto_data['ID_Producto'], $producto_data['Nombre'], $producto_data['Descripcion'], $producto_data['Precio'], $producto_data['Imagen']);
    $productos[] = $producto;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include RAIZ_APP . '/includes/vistas/comun/header.php'; ?>
    <title>Compras Back Music</title>
</head>

<body>
    <div id="contenedor">
        <?php include RAIZ_APP . '/includes/vistas/comun/cabecera.php'; ?>
        <?php include RAIZ_APP . '/includes/vistas/comun/lateralIzq.php'; ?>
        <main>
            <article>
                <section>
                    <h2>Compras Back Music</h2>
                    <p>Esta el la sección de compras de Back Music. Aquí podrás encontrar todo lo que tenemos a la
                        venta.</p>
                    <?php
                    // Verifica si hay productos para mostrar
                    if (!empty($productos)) {
                        // Itera sobre los productos y muestra la información
                        foreach ($productos as $producto) {
                            $visible = $producto->getVisible();
                            if ($visible || isset($_SESSION["esEmpleado"])) {

                                if($visible){
                                    $class = "producto";
                                } else $class = "producto productoOculto";

                                echo "<div class='$class'>";
                                //echo "<div class='producto'>";
                                echo "<a class='subr' href='detalles_producto.php?id=" . $producto->getID() . "'>"; // Enlace a la página de detalles del producto
                                echo "<img src='" . RUTA_APP . $producto->getImagen() . "' alt='Imagen del producto' id='imgCompras'>";
                                echo "<div class ='detalles'>";
                                echo "<h3>" . $producto->getNombre() . "</h3>";
                                echo "</a>";//Solo la imagen y el nombre son clickeables
                                echo "<p>" . $producto->getPrecio() . " €</p>";
                                echo "</div>";
                                echo "<div class='botones'>";
                                if (isset($_SESSION["login"])) {
                                    echo "<form action='" . RUTA_APP . "/includes/vistas/helpers/procesarCarrito.php' method='post'>"; //Procesa la adición al carro
                                    echo "<input type='hidden' name='producto_id' value='" . $producto->getID() . "'>";
                                    echo "<button class='agregar' type='submit' name='agregar_producto'>Agregar al carrito</button>";
                                    echo "</form>";
                                } else {
                                    echo "<button class='agregar' onclick=\"window.location.href='" . RUTA_SRC . "/login.php'\">Agregar al carrito</button>";
                                }

                                if (isset($_SESSION["esEmpleado"]) && $visible){
                                    echo "<form action='" . RUTA_APP . "/includes/vistas/helpers/procesarEliminacion.php' method='post'>";
                                    echo "<input type='hidden' name='producto_id' value='" . $producto->getID() . "'>";
                                    echo "<button class='borrar' type='submit' name='eliminar_producto'>Ocultar</button>";
                                    echo "</form>";
                                }
                                //si no es visible sea diferente
                                else if (isset($_SESSION["esEmpleado"])) {
                                    echo "<form action='" . RUTA_APP . "/includes/vistas/helpers/procesarReabastecer.php' method='post'>";
                                    echo "<input type='hidden' name='producto_id' value='" . $producto->getID() . "'>";
                                    echo "<button class='reabastecer' type='submit' name='reabastecer_producto'>Reabastecer</button>";
                                    echo "</form>";
                                }
                                
                                echo "</div>"; //fin div botones
                                echo "</div>"; //fin div producto
                            }
                        }
                    } else {
                        echo "<p>No se encontraron productos</p>";
                    }
                    ?>
                </section>
            </article>
        </main>
        <?php include RAIZ_APP . '/includes/vistas/comun/pieDePagina.php'; ?>
    </div>
</body>

</html>