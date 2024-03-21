<?php
    require_once(RUTA_INCL."/config.php");
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include(RUTA_VISTAS."/comun/header.php"); ?>
        <title>Login Back Music</title>
    </head>  
    <body>
        <div id="contenedor">
           
            <?php include(RUTA_VISTAS."/comun/cabecera.php"); ?>
            <?php include(RUTA_VISTAS."/comun/lateralIzq.php"); ?>

            <main>
                <h2>Inicio de sesión en BackMusic</h2>
                <form action="<?php echo RUTA_SRC?>/usuarios/procesarLogin.php" method="POST">
                <p>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </p>
                <p>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </p>
                    <input type="submit" value="Login">
                </form>

                <h3>¿No tienes cuenta en nuestra web?</h3>
                <p>Regístrate como un nuevo usuario <a href="../vistas/register.php">aquí</a></p>
            </main>
            <?php include(RUTA_VISTAS."/comun/pieDePagina.php"); ?>
        </div>
    </body>
</html>
