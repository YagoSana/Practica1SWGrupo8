<?php
// Incluye el archivo de la clase Database
include ("../helpers/baseDatos.php");
require ("../../config.php");
require ("../helpers/producto.php");
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';
require_once ("../helpers/carrito.php");

// Crea una nueva instancia de la clase Database
$db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);

// Conecta a la base de datos
$db->connect();

// Realiza la consulta para obtener todos los productos
$sql = "SELECT * FROM productos";
$result = $db->getConnection()->query($sql);

if ($result === false) {
    die('Error en la consulta SQL: ' . $db->getConnection()->$error);
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
                    // Verifica si la consulta devolvió resultados
                    if ($result->rowCount() > 0) {
                        // Itera sobre los resultados y los muestra en la tabla
                        while ($row = $result->fetch()) {
                            //Esto se hace para pasar luego el producto entero al carrito
                            $producto = new Producto($row['ID'], $row['Nombre'], $row['Descripcion'], $row['Precio'], $row['Imagen'], $db);
                            echo "<div class='producto'>";
                            echo "<img src='" . RUTA_APP . $row['Imagen'] . "' alt='Imagen del producto'>";
                            echo "<div>";
                            echo "<h3>" . $row['Nombre'] . "</h3>";
                            echo "<p>" . $row['Descripcion'] . "</p>";
                            echo "<p>" . $row['Precio'] . "</p>";
                            if (isset($_SESSION["login"])) {
                                // El usuario ha iniciado sesión, muestra el botón "Agregar al carrito"
                                echo "<form action='" . RUTA_APP . "/includes/vistas/helpers/procesarCarrito.php' method='post'>"; //Procesa la adicion al carro
                                echo "<input type='hidden' name='producto_id' value='" . $row['ID'] . "'>";
                                echo "<button type='submit' name='agregar_producto'>Agregar al carrito</button>";
                                echo "</form>";
                            } else {
                                // El usuario no ha iniciado sesión, muestra un enlace para iniciar sesión
                                echo '<button onclick="window.location.href=\''.RUTA_SRC.'/login.php\'">Agregar al carrito</button>';

                            } //Boton para eliminar el producto de la tienda
                            if (isset($_SESSION["esEmpleado"])) {
                                echo "<form action='" . RUTA_APP . "/includes/vistas/helpers/procesarEliminacion.php' method='post'>";
                                echo "<input type='hidden' name='producto_id' value='" . $row['ID'] . "'>";
                                echo "<button type='submit' name='eliminar_producto'>Eliminar</button>";
                                echo "</form>";
                            }

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

<?php
// Cierra la conexión a la base de datos
$db->close();
?>