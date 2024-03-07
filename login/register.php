<?php
    /*$db = new mysqli('127.0.0.1', 'username', 'password', 'bd');

    if($db->connect_errno) {
        echo "Error al conectarse con la base de datos: " . $db -> connect_error;
        exit();
    }

    $nombre = $db -> real_escape_string($_POST['nombre']);
    $apellido = $db -> real_escape_string($_POST['apellido']);
    $email = $db -> real_escape_string($_POST['email']);
    $usuario = $db -> real_escape_string($_POST['usuario']);
    $contraseña = $db -> real_escape_string($_POST['contraseña']);

    $sql = "INSERT INTO articulos (articulo_id, articulo_nombre, articulo_descripcion, articulo_precio) VALUES ('$articulo_id', '$articulo_nombre', '$articulo_descripcion', '$articulo_precio')";

    if (!$db -> query($sql)) {
        printf("%d Row inserted.\n", $db->affected_rows);
    }

    $db->close();*/
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
                <h2>Regístrate en BackMusic</h2>
                <form method="POST">
                <p>
                    <input type="text" id="usuario" name="usuario" placeholder="Nombre de usuario" size="30" required>
                </p>
                <p>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" size="12" required>
                    <input type="text" id="apellido" name="apellido" placeholder="Apellido" size="12" required>
                </p>
                <p>
                    <input type="Email" id="email" name="email" placeholder="email" size="30" required>
                </p>
                <p>
                    <input type="password" id="contraseña" name="contraseña" placeholder="Contraseña" size="30" required>
                </p>
                    <input type="submit" value="Registrar">
                </form>
            </main>
            <?php include("../scripts/pieDePagina.php"); ?>
        </div>
    </body>
</html>
