<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $mensaje = "Su procedimiento ha sido un éxito";
} else {
    $mensaje = "Hubo un error inesperado en el procedimiento de la solicitud";
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("../comun/header.php"); ?>
        <title>Confirmación</title>
    </head>  
    <body>
        <div id="contenedor">
            <?php include("../comun/cabecera.php"); ?>
            <?php include("../comun/lateralIzq.php"); ?>

            <main>
                <h1><?php echo $mensaje; ?></h1>
            </main>

            <?php include("../comun/pieDePagina.php"); ?>
        </div>
    </body>
</html>