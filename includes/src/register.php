<?php

require_once ("../config.php");
include RAIZ_APP . '/includes/FormularioRegister.php';

$form = new FormularioRegister();

$htmlFormRegistro = $form->gestiona();

$titulo = 'Register Back Music';

$contenido = <<<EOS
<h1>Regístrate en Back Music</h1>
$htmlFormRegistro
EOS;

require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
?>
