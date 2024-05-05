<?php
require_once ("../../config.php");
include RAIZ_APP . '/includes/FormularioUploadProducto.php';

$form = new FormularioUploadProducto();

$htmlFormUploadProducto = $form->gestiona();

$titulo = 'Añadir producto Back Music';

$contenido = <<<EOS
<h1>Añadir producto Back Music</h1>
$htmlFormUploadProducto
EOS;

require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
?>