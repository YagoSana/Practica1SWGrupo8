<?php
session_start();

//Conexion a la base de datos
$db = new mysqli('localhost', 'username', 'password', 'database')

if($db->)
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("header.php"); ?>
        <title>Index Back Music</title>
    </head>  
    <body>
        <div id="contenedor">
           
            <?php include("cabecera.php"); ?>
            <?php include("lateralIzq.php"); ?>

            <main>
                <?php
                    echo ""

                ?>

            </main>
            <?php include("pieDePagina.php"); ?>
        </div>
    </body>
</html>
