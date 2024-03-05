<?php
    session_start();

        //Comprobamos si el usuario es el dueño o admin
        if(!isset($_SESSION["esAdmin"])){

                die('Acceso denegado, no posee los privilegios requeridos');
        }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("header.php"); ?>
        <title>Login Back Music</title>
    </head>  
    <body>
        <div id="contenedor">
           
            <?php include("cabecera.php"); ?>
            <?php include("lateralIzq.php"); ?>

            <main>
                <form action="procesarArticulo.php" method="POST">
                        <p>
                                <label for="articulo_id">ID del Articulo:</label>
                                <input type="text" id="articulo_id" name="articulo_id">
                        </p>
                        <p>
                                <label for="articulo_nombre">Nombre del Articulo:</label>
                                <input type="text" id="articulo_nombre" name="articulo_nombre">
                        </p>
                        <p>
                                <label for="articulo_descripcion">Descripcion del Articulo:</label>
                                <input tpye="text" id="articulo_descripcion" name="articulo_descripcion">
                        </p>
                        <p>
                                <label for="articulo_precio">Precio del Articulo:</label>
                                <input tpye="text" id="articulo_precio" name="articulo_precio">
                        </p>
                        <input type="submit" value="Subir Articulo">
                </form>

            </main>
            <?php include("pieDePagina.php"); ?>
        </div>
    </body>
</html>
