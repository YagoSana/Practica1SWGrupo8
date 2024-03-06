<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("../scripts/header.php"); ?>
        <title> Bocetos Back Music </title>
    </head>
    <body>
        <div id="contenedor">
            <?php include("../scripts/cabecera.php"); ?>
            <?php include("../scripts/lateralIzq.php"); ?>
            <main>
                <article>
                    <section>
                        <h2>Bocetos y funcionalidades</h2> 
                        <section>
                            <h3>InfoCuenta</h3>
                            <figure>
                                <img src="../bocetos/infoCuenta.jpg" width="500px">
                                <p>En este boceto podemos ver como se divide el apartado de cuenta. Tiene
                                una sección en la que puedes ver la foto y tu información personal. Hay un boton
                                que permite editar dicha información y foto. Podemos encontrar varios botones para 
                                editar la información o foto, además de un botón para poder ver la lista de pedidos
                                </p>
                            </figure>
                        </section>
                        <section>
                            <h3>ListaPedidos</h3>
                            <figure>
                                <img src="../bocetos/listaPedidos.jpg" width="500px">
                                <p>En este otro podemos ver como se representaría la lista de pedidos. Se representara 
                                de tal forma que se vera una lista con los pedidos mostrando el nombre, la foto, y la fecha
                                estimada de cuando llegará el producto. Además al lado de cada pedido tendremos un botón para poder
                                cancelar el pedido en cualquier momento antes de la fecha de entrega.
                                </p>
                            </figure>  
                        </section>
                        <section>      
                            <h3>PaginaPrincipal</h3>
                            <figure>
                                <img src="../bocetos/paginaPrincipal.jpg" width="500px">
                                <p>En este boceto se puede apreciar como se vería la página principal de la tienda. De tal manera
                                que tenemos: El logo arriba siempre a la izquierda, una 'nav' en el que se muestren las distintas secciones
                                de la tienda a las que poder ir, un buscador, el apartado de cuenta arriba a la derecha (todos estos elementos
                                citados anteriormente se mantienen en muchas de las páginas para hacer fácilmente accesibles las pá;ginas), un apartado
                                citando Quienes Somos y finalmente una lista de los productos destacados de la tienda
                                </p>
                            </figure>
                        </section>
                        <section>
                            <h3>RegisterLogin</h3>
                            <figure>
                                <img src="../bocetos/loginRegister.jpg" width="500px">
                                <p>Aqui podemos ver como sera el apartado de login/Register. Para hacer el register se deberá; poner un correo
                                electrónico que no exista previamente en la base de datos y poner la contraseña y confirmarla. Por otro lado el
                                login se hace poniendo un correo que deba existir y poner tan solo una vez la contraseña (no aparecerá; un segundo
                                campo para confirmar la contraseña en el login). Ademá;s de los dos botones para confirmar o cancelar la solicitud
                                </p>
                            </figure>
                        </section>
                        <section>
                            <h3>SeccionCompra</h3>
                            <figure>
                                <img src="../bocetos/seccionCompra.jpg" width="500px">
                                <p>En este boceto podemos ver como se representarí;a las secciones de compra de distintos productos. Tenemos la
                                lista de productos relacionados con lo buscado y su informacion e imagen (ademá;s de los apartados principales
                                citados anteriormente), incluyendo tambien la valoración de cada producto que aparece.
                                </p>
                            </figure>
                        </section>
                        <section>      
                            <h3>SeccionVenta</h3>
                            <figure>
                                <img src="../bocetos/seccionVenta.jpg" width="500px">
                                <p>Para el boceto de ventas tenemos (tambié;n los apartados principales), secciones para hacer un upload
                                de las fotos del producto e información del producto, para que asi la tienda pueda comprarlo y darle dinero
                                al wallet del cliente, y los botones correspondientes para confirmar o cancelar la acción
                                </p>
                            </figure>
                        </section>
                        <section>        
                            <h3>ValoracionProductos</h3>
                            <figure>
                                <img src="../bocetos/valoracion.jpg" width="500px">
                                <p>Para este último boceto, se ha creado un sistema de valoraciones en el que se
                                califica por estrellas (en 5 como maximo y 1 como minimo para ser exactos), en el que ademá;s
                                se puede escribir un pequeño comentario indicando aspectos del producto, y finalmente los botones de 
                                confirmación
                                </p>
                            </figure>
                        </section>
                    </section>
                </article>
            </main>
            <?php include("../scripts/pieDePagina.php"); ?>
        </div>
    </body>
</html>