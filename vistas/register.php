<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("../logica/header.php"); ?>
        <title>Index Back Music</title>
    </head>  
    <body>
        <div id="contenedor">
           
            <?php include("../logica/cabecera.php"); ?>
            <?php include("../logica/lateralIzq.php"); ?>

            <main>
                <h2>Regístrate en BackMusic</h2>
                <form action="../logica/procesarRegister.php" method="POST">
                <p>
                    <input type="text" id="usuario" name="usuario" placeholder="Nombre de usuario" size="30" required>
                </p>
                <p>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" size="12" required>
                    <input type="text" id="apellido" name="apellido" placeholder="Apellido" size="12" required>
                </p>
                <p>
                    <input type="Email" id="email" name="email" placeholder="email" size="30" required>
                </p>
                <p>
                    <input type="password" id="contraseña" name="contraseña" placeholder="Contraseña" size="30" required>
                </p>
                <p>
                    <input type="checkbox" id="terminos" name="terminos" required>
                    <label for="terminos">Marque esta casilla para verificar que ha leído nuestros términos y condiciones del servicio</label>
                </p>
                    <input type="submit" value="Registrar">
                </form>
            </main>
            <?php include("../logica/pieDePagina.php"); ?>
        </div>
    </body>
</html>
