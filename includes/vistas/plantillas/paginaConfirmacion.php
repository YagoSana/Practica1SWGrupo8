<?php

require '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $mensaje = "Su procedimiento ha sido un éxito";
} else {
    $mensaje = "Hubo un error inesperado en el procedimiento de la solicitud";
}
$titulo = 'Confirmacion de Back Music';
$contenido = "<h1>" . $mensaje . "</h1>";
require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
