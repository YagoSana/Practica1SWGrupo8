<?php
require '../../config.php';
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';
require_once RAIZ_APP. '/includes/vistas/helpers/venta.php';
require_once '../../FormularioEditarVenta.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$id = $_GET['ventaid'];
$titulo = 'Gestión ventas Back Music';
$htmlFormVenta = "";
$venta = Venta::getVentaById($id);
    $htmlFormVenta .= "<div class='nom'>" . $venta->getNombre() . "</div>";

    $form = new FormularioEditarVenta($venta->getID(), $_SESSION['usuario']->getId());
    $htmlFormVenta .= $form->gestiona();


$contenido = <<<EOS
$htmlFormVenta
EOS;

require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';