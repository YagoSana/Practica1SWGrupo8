<?php
require_once ("../config.php");
include RAIZ_APP . '/includes/FormularioEditar.php';

$form = new FormularioEditar();

$htmlFormEditar = $form->gestiona();

$titulo = 'Login Back Music';

$contenido = <<<EOS
<h1>Edita tu perfil de Back Music</h1>
$htmlFormEditar
EOS;

require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
?>
