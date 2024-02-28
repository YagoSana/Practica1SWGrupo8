<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("header.php"); ?>
        <title> Bocetos Back Music </title>
    </head>
    <body>
        <div id="contenedor">
            <?php include("cabecera.php"); ?>
            <?php include("lateralIzq.php"); ?>
            <main>
                <article>
                    <section>
                    <h2>Bocetos y funcionalidades</h2> 
                    <h3>InfoCuenta</h3>
                    <figure>
                        <img src="../bocetos/infoCuenta.jpg" width="500px">
                        <figcaption>En este boceto podemos ver como se divide el apartado de cuenta. Tiene
                        una secci&oacute;n en la que puedes ver la foto y tu informaci&oacute;n personal. Hay un boton
                        que permite editar dicha informaci&oacute;n y foto. Podemos encontrar varios botones para 
                        editar la informaci&oacute;n o foto, adem&aacute;s de un bot&oacute;n para poder ver la lista de pedidos
                        </figcaption>
                    </figure>
                    <h3>ListaPedidos</h3>
                    <figure>
                        <img src="../bocetos/listaPedidos.jpg" width="500px">
                        <figcaption>En este otro podemos ver como se representar&iacute;a la lista de pedidos. Se representara 
                        de tal forma que se vera una lista con los pedidos mostrando el nombre, la foto, y la fecha
                        estimada de cuando llegar&aacute; el producto. Adem&aacute;s al lado de cada pedido tendremos un bot&oacute;n para poder
                        cancelar el pedido en cualquier momento antes de la fecha de entrega.
                        </figcaption>
                    </figure>        
                    <h3>PaginaPrincipal</h3>
                    <figure>
                        <img src="../bocetos/paginaPrincipal.jpg" width="500px">
                        <figcaption>En este boceto se puede apreciar como se ver&iacute;a la p&aacute;gina principal de la tienda. De tal manera
                        que tenemos: El logo arriba siempre a la izquierda, una 'nav' en el que se muestren las distintas secciones
                        de la tienda a las que poder ir, un buscador, el apartado de cuenta arriba a la derecha (todos estos elementos
                        citados anteriormente se mantienen en muchas de las p&aacute;ginas para hacer f&aacute;cilmente accesibles las p&aacute;ginas), un apartado
                        citando Quienes Somos y finalmente una lista de los productos destacados de la tienda
                        </figcaption>
                    </figure>
                    <h3>RegisterLogin</h3>
                    <figure>
                        <img src="../bocetos/loginRegister.jpg" width="500px">
                        <figcaption>Aqui podemos ver como sera el apartado de login/Register. Para hacer el register se deber&aacute; poner un correo
                        electr&oacute;nico que no exista previamente en la base de datos y poner la contrase&ntilde;a y confirmarla. Por otro lado el
                        login se hace poniendo un correo que deba existir y poner tan solo una vez la contraseña (no aparecer&aacute; un segundo
                        campo para confirmar la contrase&ntilde;a en el login). Adem&aacute;s de los dos botones para confirmar o cancelar la solicitud
                        </figcaption>
                    </figure>
                    <h3>SeccionCompra</h3>
                    <figure>
                        <img src="../bocetos/seccionCompra.jpg" width="500px">
                        <figcaption>En este boceto podemos ver como se representar&iacute;a las secciones de compra de distintos productos. Tenemos la
                        lista de productos relacionados con lo buscado y su informacion e imagen (adem&aacute;s de los apartados principales
                        citados anteriormente), incluyendo tambien la valoraci&oacute;n de cada producto que aparece.
                        </figcaption>
                    </figure>        
                    <h3>SeccionVenta</h3>
                    <figure>
                        <img src="../bocetos/seccionVenta.jpg" width="500px">
                        <figcaption>Para el boceto de ventas tenemos (tambi&eacute;n los apartados principales), secciones para hacer un upload
                        de las fotos del producto e informaci&oacute;n del producto, para que asi la tienda pueda comprarlo y darle dinero
                        al wallet del cliente, y los botones correspondientes para confirmar o cancelar la acci&oacute;n
                        </figcaption>
                    </figure>        
                    <h3>ValoracionProductos</h3>
                    <figure>
                        <img src="../bocetos/valoracion.jpg" width="500px">
                        <figcaption>Para este &uacute;ltimo boceto, se ha creado un sistema de valoraciones en el que se
                        califica por estrellas (en 5 como maximo y 1 como minimo para ser exactos), en el que adem&aacute;s
                        se puede escribir un peque&ntilde;o comentario indicando aspectos del producto, y finalmente los botones de 
                        confirmaci&oacute;n
                        </figcaption>
                    </figure>
                    </section>
                </article>
            </main>
            <?php include("pieDePagina.php"); ?>
        </div>
    </body>
</html>