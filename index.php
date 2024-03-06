<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("scripts/header.php"); ?>
        <title>Index Back Music</title>
    </head>  
    <body>
        <div id="contenedor">
           
            <?php include("scripts/cabecera.php"); ?>
            <?php include("scripts/lateralIzq.php"); ?>

            <main>
                <article>
                    <section>
                    <h2>
                        ¿Qué es Back Music?
                    </h2>
                    <p>
                        Este proyecto va a consistir en crear una aplicación web para una tienda de música online.
                    </p>
                    <p>
                        En ella, nuestros clientes pordrán comprar todo tipo de articulos musicales, de entre los cuales
                        tenemos intrumentos de cuerda, intrumentos de viento, instrumentos de percusión, accesorios, 
                        amplificadores, partituras, etc.
                    </p>
                    <p>
                        Cada uno de los clientes que compren algún articulo de nuestra tienda, podrá valorar el producto 
                        adquirido en nuestra sección de valoraciones. De esta manera, los futuros compradores de dicho 
                        artículo tengan retroalimentación sobre lo que quieren adquirir. Cabe destacar que, en las 
                        páginas individuales de venta de cada producto, aparecerán las valoraciones de ese artículo en concreto.
                    </p>
                    <p>    
                        Por otro lado, nuestros clientes también serán capaces de publicar en nuestra web instrumentos 
                        u objetos que quieran vender a otros usuarios, siendo esto, una seccion de venta de 
                        artículos de segunda mano. De esta manera, estos usuarios recibirán parte del dinero de 
                        sus ventas en forma de saldo en un monedero virtual "wallet" que podrán usar posteriormente 
                        para comprar en nuestra tienda.
                    </p>
                    </section>
                </article>
            </main>
            <?php include("scripts/pieDePagina.php"); ?>
        </div>
    </body>
</html>
