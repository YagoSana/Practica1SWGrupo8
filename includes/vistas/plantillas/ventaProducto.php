<?php
require '../../config.php';

include RAIZ_APP . '/includes/FormularioVentaProducto.php';

$form = new FormularioVentaProducto();

$htmlFormVentaProducto = $form->gestiona();

$titulo = 'Venta producto Back Music';

$contenido = <<<EOS
<h1>Venta producto Back Music</h1>
$htmlFormVentaProducto
EOS;

require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
?>
