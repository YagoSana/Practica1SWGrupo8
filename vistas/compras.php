<?php
// Incluye el archivo de la clase Database
include "baseDatos.php";

// Crea una nueva instancia de la clase Database
$db = new Database('localhost', 'username', 'password', 'bd_def');

// Conecta a la base de datos
$db->connect();

// Realiza la consulta para obtener todos los productos
$sql = "SELECT * FROM productos";
$result = $db->getConnection()->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("../logica/header.php"); ?>
        <title>Compras Back Music</title>
    </head>
    <body>
        <div id="contenedor">
            <?php include("../logica/cabecera.php"); ?>
            <?php include("../logica/lateralIzq.php"); ?>

            <main>
                <article>
                    <section>
                        <h2>Compras Back Music</h2>
                        <p>Esta el la sección de compras de Back Music. Aquí podrás encontrar las compras de nuestros clientes.</p>
                        <table>
                            <tr>
                                <th>Artículo</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                            </tr>
                            <?php
                            // Verifica si la consulta devolvió resultados
                            if ($result->rowCount() > 0) {
                                // Itera sobre los resultados y los muestra en la tabla
                                while ($row = $result->fetch()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['Nombre'] . "</td>";
                                    echo "<td>" . $row['Descripcion'] . "</td>";
                                    echo "<td>" . $row['Precio'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>No se encontraron productos</td></tr>";
                            }
                            ?>
                        </table>
                    </section>
                </article>
            </main>
            <?php include "pieDePagina.php"; ?>
        </div>
    </body>
</html>

<?php
// Cierra la conexión a la base de datos
$db->close();
?>
