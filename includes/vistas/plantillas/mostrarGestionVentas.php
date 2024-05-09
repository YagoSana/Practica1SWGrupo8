<?php
require '../../config.php';
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';
require_once RAIZ_APP. '/includes/vistas/helpers/venta.php';
require_once '../../FormularioEditarVenta.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
/*
$titulo = 'Ventas Back Music';
$contenido = <<<EOS
            <article>
                <section>
                    <h2>Administrar Ventas</h2>
                    <p> Esta es la sección de administración de ventas. Aquí puedes aceptar o rechazar las ventas. </p>
            EOS;
            $ventas = Venta::getAllVentas();

            if($ventas == null || !isset($_SESSION["esEmpleado"])) {
                $contenido .= "<p>No hay ventas para mostrar.</p>";
            } else {
                foreach($ventas as $venta) {    
                    // Aquí puedes mostrar la información de cada venta
                    $contenido .= "<div class='producto'>";
                    $contenido .= '<form action="'. RUTA_APP .'/includes/vistas/helpers/procesarAceptacionVenta.php" method="post">';
                    $contenido .= '<input type="hidden" name="venta_id" value="' . $venta['ID_Venta'] . '">';
                    $contenido .= '<input type="text" name="nombre" value="' . $venta['Nombre'] . '">'; // Campo de texto editable para el nombre
                    $contenido .= '<textarea name="descripcion" rows="4" cols="40">' . $venta['Descripcion'] . '</textarea>'; // Campo de texto editable para la descripción
                    $contenido .= "<p>Estado: " . $venta['Estado'] . "</p>";
                    $contenido .= "<img src='". RUTA_IMGS . '/imagenesBD/'.$venta['Imagen'] . "' alt='Imagen del producto'>";
                    $contenido .= '<input type="text" name="valor" placeholder="Introduce un valor">';
                    $contenido .= '<select name="categoria">';
                    $contenido .= '<option value="cuerda">Cuerda</option>';
                    $contenido .= '<option value="viento">Viento</option>';
                    $contenido .= '<option value="percusion">Percusión</option>';
                    $contenido .= '<option value="articulo">Artículo</option>';
                    $contenido .= '</select>'; // Nuevo selector para la categoría del producto que se va a añadir
                    $contenido .= '<button type="submit" name="accion" value="Aceptar">Aceptar</button>';
                    $contenido .= '<button type="submit" name="accion" value="Rechazar">Rechazar</button>';
                    $contenido .= '</form>';
                    $contenido .= "</div>";
                }
            }
            $contenido .= <<<EOS
                    </p>
                </section>
            </article>
            EOS;
require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
*/
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