<?php
// Incluye el archivo de la clase Database
require ("../../config.php");
use es\ucm\fdi\sw\vistas\helpers\producto;
use es\ucm\fdi\sw\usuarios\usuario;
use es\ucm\fdi\sw\vistas\helpers\carrito;
// Crea un array para almacenar los productos
$productos = [];

// Obtén todos los productos de la base de datos
$producto = new Producto(null, null, null, null, null);
$productos_data = $producto->getAllProductos();

// Recorre los datos de los productos y crea objetos Producto
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
                            echo "<div class='producto'>";
                            echo "<a class='subr' href='detalles_producto.php?id=" . $producto->getID() . "'>"; // Enlace a la página de detalles del producto
                            echo "<img src='" . RUTA_APP . $producto->getImagen() . "' alt='Imagen del producto' id='imgCompras'>";
                            echo "<div class ='detalles'>";
                            echo "<h3>" . $producto->getNombre() . "</h3>";
                            echo "</a>";//Solo la imagen y el nombre son clickeables
                            echo "<p>" . $producto->getPrecio() . " €</p>";
                
                            echo "<div class='botones'>";
                            if (isset($_SESSION["login"])) {
                                // El usuario ha iniciado sesión, muestra el botón "Agregar al carrito" dentro de un formulario
                                echo "<form action='" . RUTA_APP . "/includes/vistas/helpers/procesarCarrito.php' method='post'>"; //Procesa la adición al carro
                                echo "<input type='hidden' name='producto_id' value='" . $producto->getID() . "'>";
                                echo "<button class='agregar' type='submit' name='agregar_producto'>Agregar al carrito</button>";
                                echo "</form>";
                            } else {
                                // El usuario no ha iniciado sesión, muestra un enlace para iniciar sesión
                                echo "<button class='agregar' onclick=\"window.location.href='" . RUTA_SRC . "/login.php'\">Agregar al carrito</button>";
                            }

                            // Botón para eliminar el producto de la tienda, dentro de un formulario
                            if (isset($_SESSION["esEmpleado"])) {
                                echo "<form action='" . RUTA_APP . "/includes/vistas/helpers/procesarEliminacion.php' method='post'>";
                                echo "<input type='hidden' name='producto_id' value='" . $producto->getID() . "'>";
                                echo "<button class='borrar' type='submit' name='eliminar_producto'>Eliminar</button>";
                                echo "</form>";
                            }
                            
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
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
