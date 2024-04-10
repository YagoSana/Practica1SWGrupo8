<?php
require_once __DIR__ . '/../../config.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include RAIZ_APP . '/includes/vistas/comun/header.php'; ?>
    <title>Back Music</title>
</head>

<body>
    <div id="contenedor">
        <?php include RAIZ_APP . '/includes/vistas/comun/cabecera.php'; ?>
        <?php include RAIZ_APP . '/includes/vistas/comun/lateralIzq.php'; ?>
        <main>
            <article>
                <section>
                    <h2>¿Quiénes somos?</h2>
                    <p>
                        Back Music es una pequeña tienda en el centro de Madrid, localizada en el barrio Chamartín, que quiere hacer el acceso a la música algo para todos. 
                        Se puede disfrutar de nuestros servicios tanto online como en la tienda, desde comprar instrumentos hasta poder vender los tuyos propios y 
                        recibir dinero para próximos descuentos en la tienda.
                    </p>
                    <p>
                        Nuestro equipo está formado por un grupo de jóvenes apasionados por la música y la tecnología, que quieren hacer de la compra de instrumentos 
                        algo sencillo y accesible para todos.
                    </p>
                </section>
            </article>
        </main>
        <?php include RAIZ_APP . '/includes/vistas/comun/pieDePagina.php'; ?>
    </div>
</body>

</html>