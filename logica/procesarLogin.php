<?php   
    $db = new mysqli('127.0.0.1', 'username', 'password', 'bd_def');

    $User = $db -> real_escape_string($_POST['username']);
    $Pass = $db -> real_escape_string($_POST['password']);

    $sql = "select * from usuario where User = '$User' and pass = '$Pass'";
    $result = $conn->query($sql);

    if($result->num_rows == 1) {
        $_SESSION["login"] = true;
        $_SESSION["nombre"] = $User;
    }

    /*
    if ($username == "usuario" && $password == "usuariopass") {
        $_SESSION["login"] = true;
        $_SESSION["nombre"] = "Usuario";
    } else if ($username == "admin"&& $password == "adminpass") {
        $_SESSION["login"] = true;
        $_SESSION["nombre"] = "Administador";
        $_SESSION["esAdmin"] = true;
    }*/
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




