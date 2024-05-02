<?php
require_once ("../config.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include RAIZ_APP . '/includes/vistas/comun/header.php'; ?>
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS?>/estilos.css">
    <title>Login Back Music</title>
</head>

<body>
    <div id="contenedor">
        <?php include RAIZ_APP . '/includes/vistas/comun/cabecera.php'; ?>
        <?php include RAIZ_APP . '/includes/vistas/comun/lateralIzq.php'; ?>
        <main id="login-form">
            <h2>Inicio de sesión en BackMusic</h2>

            <form action="<?php echo RUTA_SRC ?>/usuarios/procesarLogin.php" method="POST">
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
            <p>Regístrate como un nuevo usuario <a href="./register.php">aquí</a></p>
        </main>
        <?php include RAIZ_APP . '/includes/vistas/comun/pieDePagina.php'; ?>
    </div>
</body>

</html>