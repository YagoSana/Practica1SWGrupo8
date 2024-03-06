<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("../scripts/header.php"); ?>
        <title>Login Back Music</title>
    </head>  
    <body>
        <div id="contenedor">
           
            <?php include("../scripts/cabecera.php"); ?>
            <?php include("../scripts/lateralIzq.php"); ?>

            <main>
                <form action="../login/procesarLogin.php" method="POST">
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
            </main>
            <?php include("../scripts/pieDePagina.php"); ?>
        </div>
    </body>
</html>
