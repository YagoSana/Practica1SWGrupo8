<?php
session_start();

//Conexion a la base de datos
$db = new mysqli('localhost', 'username', 'password', 'database');

if($db->connect_error) {

    die("No se ha podido conectar con la base de datos: " . $db->connect_error);
}

$articulo_id = intval($_POST['articulo_id']);
$articulo_nombre = $db->real_escape_string($_POST['articulo_nombre']);
$articulo_descripcion = $db->real_escape_string($_POST['articulo_descripcion']);
$articulo_precio = floatval($_POST['articulo_precio']);

//Insertamos el producto en la base de datos

$sql "INSERT INTO articulos (articulo_id, articulo_nombre, articulo_descripcion, articulo_precio) VALUES ($articulo_id, '$articulo_nombre', '$articulo_descripcion', '$articulo_precio')";

if($db->query($sql) === TRUE){
    echo "Se ha subido el articulo a la BD de manera exitosa";
}
else {
    echo "Error: " . $sql . " " . $db->error; 
}

$db->close();
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
