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
                                <th>Imagen</th>
                                <th>Artículo</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                            </tr>
                            <?php
                            // Loop through the product data and display it in the table
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td><img src='" . $row['image'] . "' alt='Product Image'></td>";
                                    echo "<td>" . $row['Nombre'] . "</td>";
                                    echo "<td>" . $row['Descripcion'] . "</td>";
                                    echo "<td>" . $row['Precio'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>No products found</td></tr>";
                            }
                            ?>
                        </table>
                    </section>
                </article>
            </main>
            <?php include("../logica/pieDePagina.php"); ?>
        </div>
    </body>
</html>

<?php
// Close the database connection
$conn->close();
?>