<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("../logica/header.php"); ?>
        <title>Login Back Music</title>
    </head>  
    <body>
        <div id="contenedor">
           
            <?php include("../logica/cabecera.php"); ?>
            <?php include("../logica/lateralIzq.php"); ?>

            <main>
                <form action="../logica/procesarProducto.php" method="POST">
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
            <?php include("../logica/pieDePagina.php"); ?>
        </div>
    </body>
</html>
