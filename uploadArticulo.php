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
                                <label for="id">ID del Articulo:</label>
                                <input type="text" id="id" name="id">
                        </p>
                        <p>
                                <label for="nombre">Nombre del Articulo:</label>
                                <input type="text" id="nombre" name="nombre">
                        </p>
                        <p>
                                <label for="descripcion">Descripcion del Articulo:</label>
                                <input tpye="text" id="descripcion" name="descripcion">
                        </p>
                        <p>
                                <label for="precio">Precio del Articulo:</label>
                                <input tpye="text" id="precio" name="precio">
                        </p>
                        <input type="submit" value="Subir Articulo">
                </form>

            </main>
            <?php include("pieDePagina.php"); ?>
        </div>
    </body>
</html>
