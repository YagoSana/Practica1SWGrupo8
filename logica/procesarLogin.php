<?php   
    session_start();
    include(RUTA_APP."/logica/usuario.php");
    $db = new mysqli('127.0.0.1', 'username', 'password', 'bd_def');

    $User = $db -> real_escape_string($_POST['username']);
    $Pass = $db -> real_escape_string($_POST['password']);

    if($User != "admin") {
        $sql = "SELECT * FROM usuario WHERE User = '$User' AND Pass = '$Pass'";

        $result = $db->query($sql);
        if($result->num_rows === 1) {
            $_SESSION["login"] = true;
            $_SESSION["nombre"] = $User;
            $usuario = new Usuario($User);
            $_SESSION["usuario"] = $usuario;
        }
    } else if($Pass == "adminpass"){
        $_SESSION["login"] = true;
        $_SESSION["nombre"] = "Administrador";
        $_SESSION["esAdmin"] = true;
        $usuario = new Usuario($User);
        $_SESSION["usuario"] = $usuario;
    }

    $db->close();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include(RUTA_APP."/logica/header.php"); ?>
        <title>Index Back Music</title>
    </head>  
    <body>
        <div id="contenedor">
           
            <?php include(RUTA_APP."/logica/cabecera.php"); ?>
            <?php include(RUTA_APP."/logica/lateralIzq.php"); ?>

            <main>
                <?php
                    if (!isset($_SESSION["login"])) {
                        echo "<h1>Error en el login</h1>";
                        echo "<p>El usuario o la contraseña no son validos.</p>";
                    }
                    else {
                        echo "<h1>Bienvenido {$_SESSION['nombre']}</h1>";
                        echo "<p>Usa el menú de la izquierda para navegar.</p>";
                    }
                ?>
            </main>
            <?php include(RUTA_APP."/logica/pieDePagina.php"); ?>
        </div>
    </body>
</html>




