<?php
session_start();
require_once '../../config.php';
//require 'Usuario.php';
use es\ucm\fdi\sw\src\usuarios\Usuario;
use es\ucm\fdi\sw\vistas\helpers\Database;
//require_once RAIZ_APP . '/includes/vistas/helpers/Database.php';

$db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);
$db->connect();

$User = $_POST['username'];
$Pass = $_POST['password'];

$sql = "SELECT * FROM Usuario WHERE User = '$User' AND Pass = '$Pass'";
$result = $db->getConnection()->query($sql);

if ($result->rowCount() == 1) {
    $_SESSION["login"] = true;
    $_SESSION["nombre"] = $User;
    $row = $result->fetch();
    if ($row["rol"] == "empleado") {
        $_SESSION["esEmpleado"] = true;
    }
    if ($row["rol"] == "admin") {
        $_SESSION["esEmpleado"] = true;
        $_SESSION["esAdmin"] = true;
    }
    
    Usuario::login($User, $Pass);
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

$db->close();
?>