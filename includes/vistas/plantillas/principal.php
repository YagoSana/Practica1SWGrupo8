<?php
require_once __DIR__ . '/../../config.php';

$ruta = RUTA_SRC;
$titulo = 'Página principal de Back Music';
$contenido = <<<EOS
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
    EOS;
require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';

