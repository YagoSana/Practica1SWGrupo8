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
                <h2>Indique el producto a eliminar</h2>
                <form action="../logica/procesarEliminacion.php" method="POST">
                        <p>
                                <label for="producto_id">Identificador:</label>
                                <input type="text" id="producto_id" name="producto_id" required>
                        </p>
                        <input type="submit" value="Eliminar producto">
                </form>

            </main>
            <?php include("../logica/pieDePagina.php"); ?>
        </div>
    </body>
</html>
