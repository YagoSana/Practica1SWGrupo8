<?php
    session_start();
    $username = htmlspecialchars(trim(strip_tags($_REQUEST["username"])));
    $password = htmlspecialchars(trim(strip_tags($_REQUEST["password"])));

    if ($username == "usuario" && $password == "usuariopass") {
        $_SESSION["login"] = true;
        $_SESSION["nombre"] = "Usuario";
    } else if ($username == "admin"&& $password == "adminpass") {
        $_SESSION["login"] = true;
        $_SESSION["nombre"] = "Administador";
        $_SESSION["esAdmin"] = true;
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("../scripts/header.php"); ?>
        <title>Index Back Music</title>
    </head>  
    <body>
        <div id="contenedor">
           
            <?php include("../scripts/cabecera.php"); ?>
            <?php include("../scripts/lateralIzq.php"); ?>

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
            <?php include("../scripts/pieDePagina.php"); ?>
        </div>
    </body>
</html>




