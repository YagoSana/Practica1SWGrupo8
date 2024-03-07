<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("../src/logica/header.php"); ?>
        <title>Compras Back Music</title>
    </head>
    <body>
        <div id="contenedor">
            <?php include("../src/logica/cabecera.php"); ?>
            <?php include("../src/logica/lateralIzq.php"); ?>

            <main>
                <article>
                    <section>
                        <h2>Compras Back Music</h2>
                        <p>Esta el la sección de compras de Back Music. Aquí podrís encontrar las compras de nuestros clientes.</p>
                        <table>
                            <tr>
                                <th>Imagen</th>
                                <th>Artículo</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                            </tr>
                            <?php
                            for ($i = 0; $i < 6; $i++) {
                                echo "<tr>";
                                for ($j = 1; $j <= 4; $j++) {
                                    $celda = 4*$i + $j;
                                    echo "<td>N.$celda</td>";
                                }
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </section>
                </article>
            </main>
            <?php include("../src/logica/pieDePagina.php"); ?>
        </div>
    </body>
</html>