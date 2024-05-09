<?php
require '../../config.php';
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';
require_once RAIZ_APP. '/includes/vistas/helpers/venta.php';
require_once '../../FormularioEditarVenta.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$htmlFormVenta = "";
$ventas = Venta::getAllVentas();

foreach($ventas as $venta) {

    $htmlFormVenta .= "<div class='nom'>" . $venta['Nombre'] . "</div>";

    $form = new FormularioEditarVenta($venta['ID_Venta'], $_SESSION['usuario']->getId());
    $htmlFormVenta .= $form->gestiona();
}

$contenido = <<<EOS
$htmlFormVenta
EOS;

require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';