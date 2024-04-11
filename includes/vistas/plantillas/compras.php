<?php
// Incluye el archivo de la clase Database
//include ("../helpers/Database.php");
use es\ucm\fdi\sw\vistas\helpers\Database;
require ("../../config.php");
//require_once ("../helpers/Producto.php");
use es\ucm\fdi\sw\vistas\helpers\Producto;
use es\ucm\fdi\sw\usuarios\Usuario;
//require_once RAIZ_APP. '/includes/src/Usuarios/Usuario.php';
//require_once ("../helpers/Carrito.php");
use es\ucm\fdi\sw\vistas\helpers\Carrito;


// Crea un array para almacenar los Productos
$Productos = [];

// Obtén todos los Productos de la base de datos
$Producto = new Producto(null, null, null, null, null);
$Productos_data = $Producto->getAllProductos();

// Recorre los datos de los Productos y crea objetos Producto
foreach ($Productos_data as $Producto_data) {
    $Producto = new Producto($Producto_data['ID_Producto'], $Producto_data['Nombre'], $Producto_data['Descripcion'], $Producto_data['Precio'], $Producto_data['Imagen']);
    $Productos[] = $Producto;
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
                    // Verifica si hay Productos para mostrar
                    if (!empty($Productos)) {
                        // Itera sobre los Productos y muestra la información
                        foreach ($Productos as $Producto) {
                            echo "<div class='Producto'>";
                            echo "<a class='subr' href='detalles_Producto.php?id=" . $Producto->getID() . "'>"; // Enlace a la página de detalles del Producto
                            echo "<img src='" . RUTA_APP . $Producto->getImagen() . "' alt='Imagen del Producto' id='imgCompras'>";
                            echo "<div class ='detalles'>";
                            echo "<h3>" . $Producto->getNombre() . "</h3>";
                            echo "</a>";//Solo la imagen y el nombre son clickeables
                            echo "<p>" . $Producto->getPrecio() . " €</p>";
                
                            echo "<div class='botones'>";
                            if (isset($_SESSION["login"])) {
                                // El Usuario ha iniciado sesión, muestra el botón "Agregar al Carrito" dentro de un formulario
                                echo "<form action='" . RUTA_APP . "/includes/vistas/helpers/procesarCarrito.php' method='post'>"; //Procesa la adición al carro
                                echo "<input type='hidden' name='Producto_id' value='" . $Producto->getID() . "'>";
                                echo "<button class='agregar' type='submit' name='agregar_Producto'>Agregar al Carrito</button>";
                                echo "</form>";
                            } else {
                                // El Usuario no ha iniciado sesión, muestra un enlace para iniciar sesión
                                echo "<button class='agregar' onclick=\"window.location.href='" . RUTA_SRC . "/login.php'\">Agregar al Carrito</button>";
                            }

                            // Botón para eliminar el Producto de la tienda, dentro de un formulario
                            if (isset($_SESSION["esEmpleado"])) {
                                echo "<form action='" . RUTA_APP . "/includes/vistas/helpers/procesarEliminacion.php' method='post'>";
                                echo "<input type='hidden' name='Producto_id' value='" . $Producto->getID() . "'>";
                                echo "<button class='borrar' type='submit' name='eliminar_Producto'>Eliminar</button>";
                                echo "</form>";
                            }
                            
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No se encontraron Productos</p>";
                    }
                    ?>
                </section>
            </article>
        </main>
        <?php include RAIZ_APP . '/includes/vistas/comun/pieDePagina.php'; ?>
    </div>
</body>

</html>
