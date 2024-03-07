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
        <?php include("../logica/header.php"); ?>
        <title>Confirmación</title>
    </head>  
    <body>
        <div id="contenedor">
            <?php include("../logica/cabecera.php"); ?>
            <?php include("../logica/lateralIzq.php"); ?>

            <main>
                <h1><?php echo $mensaje; ?></h1>
            </main>

            <?php include("../logica/pieDePagina.php"); ?>
        </div>
    </body>
</html>