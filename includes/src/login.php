<?php
require_once ("../config.php");
include RAIZ_APP . '/includes/FormularioLogin.php';

$form = new FormularioLogin();

$htmlFormLogin = $form->gestiona();

$titulo = 'Login Back Music';

$contenido = <<<EOS
<h1>Login Back Music</h1>
$htmlFormLogin
EOS;

require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
?>
