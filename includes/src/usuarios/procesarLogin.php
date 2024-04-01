<?php
session_start();
require_once '../../config.php';
require 'usuario.php';
require RAIZ_APP . '/includes/vistas/helpers/baseDatos.php';

$db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);
$db->connect();

$User = $_POST['username'];
$Pass = $_POST['password'];


$sql = "SELECT * FROM usuario WHERE User = '$User' AND Pass = '$Pass'";
$result = $db->getConnection()->query($sql);

if ($result->rowcount() == 1) {
    $_SESSION["login"] = true;
    $_SESSION["nombre"] = $User;
    $usuario = new Usuario($User);
    $_SESSION["usuario"] = $usuario;

    $row = $result->fetch();
    if ($row["User"] == "admin") {
        $_SESSION["esAdmin"] = true;
    }
}


$db->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include RAIZ_APP . '/includes/vistas/comun/header.php'; ?>
    <title>Index Back Music</title>
</head>

<body>
    <div id="contenedor">
        <?php include RAIZ_APP . '/includes/vistas/comun/cabecera.php'; ?>
        <?php include RAIZ_APP . '/includes/vistas/comun/lateralIzq.php'; ?>
        <main>
            <?php
            if (!isset($_SESSION["login"])) {
                echo "<h1>Error en el login</h1>";
                echo "<p>El usuario o la contraseña no son validos.</p>";
            } else {
                echo "<h1>Bienvenido {$_SESSION['nombre']}</h1>";
                echo "<p>Usa el menú de la izquierda para navegar.</p>";
            }
            ?>
        </main>
        <?php include RAIZ_APP . '/includes/vistas/comun/pieDePagina.php'; ?>
    </div>
</body>

</html>