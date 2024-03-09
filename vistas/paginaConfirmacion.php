<?php
require_once '../logica/config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $mensaje = "Su procedimiento ha sido un éxito";
} else {
    $mensaje = "Hubo un error inesperado en el procedimiento de la solicitud";
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include(RUTA_APP ."/logica/header.php"); ?>
        <title>Confirmación</title>
    </head>  
    <body>
        <div id="contenedor">
            <?php include(RUTA_APP ."/logica/cabecera.php"); ?>
            <?php include(RUTA_APP ."/logica/lateralIzq.php"); ?>

            <main>
                <h1><?php echo $mensaje; ?></h1>
            </main>

            <?php include(RUTA_APP ."/logica/pieDePagina.php"); ?>
        </div>
    </body>
</html>