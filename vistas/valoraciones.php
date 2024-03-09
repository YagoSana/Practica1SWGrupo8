<?php
    require_once '../logica/config.php';
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include(RUTA_APP ."/logica/header.php"); ?>
        <title>Valoraciones Back Music</title>
    </head>
    <body>
        <div id="contenedor">
            <?php include(RUTA_APP ."/logica/cabecera.php"); ?>
            <?php include(RUTA_APP ."/logica/lateralIzq.php"); ?>

            <main>
                <article>
                    <section>
                        <h2>Valoraciones Back Music</h2>
                        <p>
                        Esta el la sección de valoraciones de Back Music. Aquí podrís encontrar las valoraciones de nuestros clientes.
                        </p>
                    </section>
                </article>
            </main>
            <?php include(RUTA_APP ."/logica/pieDePagina.php"); ?>
        </div>
    </body>
</html>