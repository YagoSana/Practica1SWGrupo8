<?php
require '../../config.php';
include RAIZ_APP . '/includes/FormularioValoracion.php';

$form = new FormularioValoracion();

$htmlFormLogin = $form->gestiona();

$titulo = 'Valoraciones';

$contenido = <<<EOS
<h1>Valoraciones</h1>
$htmlFormLogin
EOS;

require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
?>