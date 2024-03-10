<?php 
    session_start();
    require_once 'config.php';
    require 'usuario.php';
    require 'baseDatos.php';

    $db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);
    $db->connect();

    $User = $_POST['username'];
    $Pass = $_POST['password'];

    if($User != "admin") {
        $sql = "SELECT * FROM usuario WHERE User = '$User' AND Pass = '$Pass'";
        $result = $db->getConnection()->query($sql);

        if($result->rowcount() == 1) {
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
                        echo "<h1>Error en el login</h1>";
                        echo "<p>El usuario o la contraseña no son validos.</p>";
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




