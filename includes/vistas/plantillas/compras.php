<?php
// Incluye el archivo de la clase Database
include("../helpers/baseDatos.php");
include("../config.php");

// Crea una nueva instancia de la clase Database
$db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);

// Conecta a la base de datos
$db->connect();

// Realiza la consulta para obtener todos los productos
$sql = "SELECT * FROM productos";
$result = $db->getConnection()->query($sql);

if ($result === false) {
    die('Error en la consulta SQL: ' . $db->getConnection()->error);
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("../comun/header.php"); ?>
        <title>Compras Back Music</title>
        <link rel="stylesheet" href="estilos.css"> 
    </head>
    <body>
        <div id="contenedor">
            <?php include("../comun/cabecera.php"); ?>
            <?php include("../comun/lateralIzq.php"); ?>

            <main>
                <article>
                    <section>
                        <h2>Compras Back Music</h2>
                        <p>Esta el la sección de compras de Back Music. Aquí podrás encontrar las compras de nuestros clientes.</p>
                        <?php
                        // Verifica si la consulta devolvió resultados
                        if ($result->rowCount() > 0) {
                            // Itera sobre los resultados y los muestra en la tabla
                            while ($row = $result->fetch()) {
                                echo "<div class='producto'>";
                                echo "<img src='" . $row['Imagen'] . "' alt='Imagen del producto'>";
                                echo "<div>";
                                echo "<h3>" . $row['Nombre'] . "</h3>";
                                echo "<p>" . $row['Descripcion'] . "</p>";
                                echo "<p>" . $row['Precio'] . "</p>";
                                if($_SESSION["esAdmin"]) {
                                    echo "<form action='procesarEliminacion.php' method='post'>";
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
            <?php include("../comun/pieDePagina.php"); ?>
        </div>
    </body>
</html>

<?php
// Cierra la conexión a la base de datos
$db->close();
?>
