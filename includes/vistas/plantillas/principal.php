<?php
    require_once __DIR__ . '/../../config.php';
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("../comun/header.php"); ?>
        <title>Back Music</title>
    </head>
    <body>
        <div id="contenedor">
            <?php include("../comun/cabecera.php"); ?>
            <?php include("../comun/lateralIzq.php"); ?>

            <main>
            <article>
                <section>
                    <h2>¿Quiénes somos?</h2>
                    <p>
                    Somos una pequeña tienda en el centro de Madrid, en el barrio Chamartín, que quiere hacer el acceso a la 
                    música algo para todos. Se puede disfrutar de nuestros servicios tanto online como en la tienda, 
                    desde comprar instrumentos hasta poder venderlos y recibir dinero para próximos descuentos en la tienda.
                    </p>
                </section>
                <section>
                    <h2>Artículos destacados</h2>
                    <p>Aquí se mostrarán los artículos más vendidos de la tienda.</p>
                </section>
            </article>
            </main>
            <?php include("../comun/pieDePagina.php"); ?>
        </div>
    </body>
</html>