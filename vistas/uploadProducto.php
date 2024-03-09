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
        <?php include(RUTA_APP ."/logica/header.php"); ?>
        <title>Login Back Music</title>
    </head>  
    <body>
        <div id="contenedor">
           
            <?php include(RUTA_APP ."/logica/cabecera.php"); ?>
            <?php include(RUTA_APP ."/logica/lateralIzq.php"); ?>

            <main>
                <form action="<?php echo RUTA_APP?>/logica/procesarProducto.php" method="POST">
                        <p>
                                <label for="producto_nombre">Nombre del Producto:</label>
                                <input type="text" id="producto_nombre" name="producto_nombre">
                        </p>
                        <p>
                                <label for="producto_descripcion">Descripcion del Producto:</label>
                        </p>
                        <p>
                                <textarea id="producto_descripcion" name="producto_descripcion" rows="4" cols="50" required></textarea>
                        </p>

                        <p>
                                <label for="producto_precio">Precio del Producto:</label>
                                <input tpye="text" id="producto_precio" name="producto_precio">
                        </p>
                        <input type="submit" value="Subir Producto">
                </form>

            </main>
            <?php include(RUTA_APP ."/logica/pieDePagina.php"); ?>
        </div>
    </body>
</html>
