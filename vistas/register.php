<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include(RUTA_APP ."/logica/header.php"); ?>
        <title>Index Back Music</title>
    </head>  
    <body>
        <div id="contenedor">
           
            <?php include(RUTA_APP ."/logica/cabecera.php"); ?>
            <?php include("../logica/lateralIzq.php"); ?>

            <main>
                <h2>Regístrate en BackMusic</h2>
                <form action="<?php echo RUTA_APP?>/logica/procesarRegister.php" method="POST">
                <p>
                    <input type="text" id="User" name="User" placeholder="Nombre de usuario" size="30" required>
                </p>
                <p>
                    <input type="text" id="Nombre" name="Nombre" placeholder="Nombre" size="12" required>
                    <input type="text" id="Apellido" name="Apellido" placeholder="Apellido" size="12" required>
                </p>
                <p>
                    <input type="Email" id="Email" name="Email" placeholder="Email" size="30" required>
                </p>
                <p>
                    <input type="password" id="Pass" name="Pass" placeholder="Contraseña" size="30" required>
                </p>
                <p>
                    <input type="checkbox" id="terminos" name="terminos" required>
                    <label for="terminos">Marque esta casilla para verificar que ha leído nuestros términos y condiciones del servicio</label>
                </p>
                    <input type="submit" value="Registrar">
                </form>
            </main>
            <?php include(RUTA_APP ."/logica/pieDePagina.php"); ?>
        </div>
    </body>
</html>
