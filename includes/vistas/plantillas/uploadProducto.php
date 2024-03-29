<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("../comun/header.php"); ?>
        <title>Login Back Music</title>
    </head>  
    <body>
        <div id="contenedor">
           
            <?php include("../comun/cabecera.php"); ?>
            <?php include("../comun/lateralIzq.php"); ?>

            <main>
                <form action="../helpers/procesarProducto.php" method="POST" enctype="multipart/form-data">
                        <p>
                                <label for="producto_id">Identificador:</label>
                                <input type="text" id="producto_id" name="producto_id" required>
                        </p>
                        <p>
                                <label for="producto_nombre">Nombre del Producto:</label>
                                <input type="text" id="producto_nombre" name="producto_nombre" required>
                        </p>
                        <p>
                                <label for="producto_descripcion">Descripcion del Producto:</label>
                        </p>
                        <p>
                                <textarea id="producto_descripcion" name="producto_descripcion" rows="4" cols="50" required></textarea>
                        </p>
                        <p>
                                <label for="producto_precio">Precio del Producto:</label>
                                <input type="text" id="producto_precio" name="producto_precio" required>
                        </p>
                        <p>
                                <label for="producto_imagen">Imagen del Producto:</label>
                                <input type="file" id="producto_imagen" name="producto_imagen" required>
                        </p>
                        <input type="submit" value="Subir Producto">
                </form>

            </main>
            <?php include("../comun/pieDePagina.php"); ?>
        </div>
    </body>
</html>
