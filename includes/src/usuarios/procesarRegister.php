<?php
session_start();
require_once '../../config.php';
require 'usuario.php';
require RAIZ_APP . '/includes/vistas/helpers/baseDatos.php';

$db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);
$db->connect();

$Nombre = $_POST['Nombre'];
$Apellido = $_POST['Apellido'];
$Email = $_POST['Email'];
$User = $_POST['User'];
$Pass = $_POST['Pass'];

$check_user = "SELECT * FROM usuario WHERE User = '$User'";
$result = $db->getConnection()->query($check_user);

if ($result->rowcount() == 0) {
    $sql = "INSERT INTO usuario (Nombre, Apellido, Email, User, Pass) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->getConnection()->prepare($sql);
    $stmt->execute([$Nombre, $Apellido, $Email, $User, $Pass]);

    if ($stmt->rowCount() > 0) {
        define('REGISTRADO', true);
        $_SESSION["nombre"] = $User;
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
            if (!REGISTRADO) {
                echo "<h1>Error al registrarse</h1>";
                echo "<p>El usuario indicado ya está registrado.</p>";
            } else {
                echo "<h1>Bienvenido {$_SESSION['nombre']}</h1>";
                echo "<p>Ahora ya puedes iniciar sesión en nuestra tienda.</p>";
            }
            ?>
        </main>
        <?php include RAIZ_APP . '/includes/vistas/comun/pieDePagina.php'; ?>
    </div>
</body>

</html>