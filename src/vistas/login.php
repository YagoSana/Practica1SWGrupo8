<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("../src/logica/header.php"); ?>
        <title>Login Back Music</title>
    </head>  
    <body>
        <div id="contenedor">
           
            <?php include("../src/logica/cabecera.php"); ?>
            <?php include("../src/logica/lateralIzq.php"); ?>

            <main>
                <h2>Inicio de sesión en BackMusic</h2>
                <form action="../src/logica/procesarLogin.php" method="POST">
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
                <p>Regístrate como un nuevo usuario <a href="../src/vistas/register.php">aquí</a></p>
            </main>
            <?php include("../src/logica/pieDePagina.php"); ?>
        </div>
    </body>
</html>
