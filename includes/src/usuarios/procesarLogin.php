<?php
session_start();
require_once '../../config.php';
require 'usuario.php';

$User = $_POST['username'];
$Pass = $_POST['password'];

$usuario = Usuario::login($User, $Pass);

if ($usuario) {
    echo "entra en usuario";
    $_SESSION["login"] = true;
    $_SESSION["nombre"] = $User;
    
    if ($row["rol"] == "empleado") {
        $_SESSION["esEmpleado"] = true;
    }
    if ($row["rol"] == "admin") {
        $_SESSION["esEmpleado"] = true;
        $_SESSION["esAdmin"] = true;
    }
    
    usuario::login($User, $Pass);
}

if (isset($_SESSION["login"])) {
    header('Location: ' . RUTA_APP . '/index.php');
} else {
    $ruta = RUTA_SRC;   
    $contenido = <<<EOS
    <h2> Error en el inicio de sesión </h2>
    <h2>Inicio de sesión en BackMusic</h2>

            <form action="$ruta/Usuarios/procesarLogin.php" method="POST">
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
            <p>Regístrate como un nuevo Usuario <a href="../register.php">aquí</a></p>
    EOS;
    require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
}

?>