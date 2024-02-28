<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("header.php"); ?>
        <title>Contacto Back Music</title>
    </head>
    <body>
        <div id="contenedor">
            <?php include("cabecera.php"); ?>
            <?php include("lateralIzq.php"); ?>
            <main>
                <article>
                    <section>
                        <h2>Por favor, rellene el siguiente formulario para contactar con nosotros:</h2>
                        <form action="mailto:contactoBackMusic@ucm.es" method="post" enctype="text/plain"> <!-- correo inventado -->
                            <p>
                                <label for="nombre">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" required>
                            </p>
                            <p>
                                <label for="email">Email de contacto:</label>
                                <input type="email" id="email" name="email" required>
                            </p>
                            <p>
                                Motivo de la consulta:
                            </p>
                            <p>
                                <input type="radio" id="evaluacion" name="motivo" value="evaluacion" required>
                                <label for="evaluacion">Evaluaci&oacute;n</label>
                            </p>
                            <p>
                                <input type="radio" id="sugerencias" name="motivo" value="sugerencias" required>
                                <label for="sugerencias">Sugerencias</label>
                            </p>
                            <p>
                                <input type="radio" id="criticas" name="motivo" value="criticas" required>
                                <label for="criticas">Cr&iacute;ticas</label>
                            </p>
                            <p>
                                <input type="checkbox" id="terminos" name="terminos" required>
                                <label for="terminos">Marque esta casilla para verificar que ha le&iacute;do nuestros t&eacute;rminos y condiciones del servicio</label>
                            </p>
                            <p>
                                Consulta:
                            </p>
                            <p>
                                <textarea id="consulta" name="consulta" rows="4" cols="50" required></textarea>
                            </p>
                            <input type="submit" value="Enviar">
                            <input type="reset" value="Limpiar">
                        </form>
                    </section>
                </article>
            </main>
            <?php include("pieDePagina.php"); ?>
        </div>
    </body>
</html>