<?php
    session_start();
    include("usuario.php");
    $db = new mysqli('127.0.0.1', 'username', 'password', 'bd_def');

    if($db->connect_errno) {
        echo "Error al conectarse con la base de datos: " . $db -> connect_error;
        exit();
    }

    $Nombre = $db -> real_escape_string($_POST['Nombre']);
    $Apellido = $db -> real_escape_string($_POST['Apellido']);
    $Email = $db -> real_escape_string($_POST['Email']);
    $User = $db -> real_escape_string($_POST['User']);
    $Pass = $db -> real_escape_string($_POST['Pass']);

    $check_user = "SELECT * FROM usuario WHERE User = '$User'";
    $result = $db->query($check_user);
    if($result->num_rows == 0) {
        $sql = "INSERT INTO usuario (Nombre, Apellido, Email, User, Pass) VALUES ('$Nombre', '$Apellido', '$Email', '$User', '$Pass')";

        if (!$db -> query($sql)) {
            printf("%d Row inserted.\n", $db->affected_rows);
        }

        $_SESSION["login"] = true;
        $_SESSION["nombre"] = $User;
        $usuario = new Usuario($User);
        $_SESSION["usuario"] = $usuario;
    }

    $db->close();
?>

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
                <?php
                    if (!isset($_SESSION["login"])) {
                        echo "<h1>Error al registrarse</h1>";
                        echo "<p>El usuario indicado ya está registrado.</p>";
                    }
                    else {
                        echo "<h1>Bienvenido {$_SESSION['nombre']}</h1>";
                        echo "<p>Usa el menú de la izquierda para navegar.</p>";
                    }
                ?>
            </main>
            <?php include("../logica/pieDePagina.php"); ?>
        </div>
    </body>
</html>