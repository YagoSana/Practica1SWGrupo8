<?php

require_once ("../config.php");
include RAIZ_APP . '/includes/FormularioRegister.php';

$form = new FormularioRegister();

$htmlFormRegistro = $form->gestiona();

$tituloPagina = 'Registro';

$contenido = <<<EOS
<h1>Registro de usuario</h1>
$htmlFormRegistro
EOS;

require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
?>
