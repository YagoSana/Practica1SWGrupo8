<?php
require_once ("../config.php");
include RAIZ_APP . '\includes\FormularioLogin.php';

$form = new FormularioLogin();
$htmlFormLogin = $form->gestiona();

$tituloPagina = 'Login';

$contenido = <<<EOS
<h1>Acceso al sistema</h1>
$htmlFormLogin
EOS;

require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
?>
