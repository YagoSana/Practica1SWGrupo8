<?php
require '../../config.php';
require_once RAIZ_APP . '/includes/src/usuarios/usuario.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$titulo = 'Ventas Back Music';
$contenido = <<<EOS
            <article>
                <section>
                    <h2>Ventas de Back Music</h2>
                    <h3>¿Tienes un instrumento musical que ya no utilizas y quieres venderlo?</h3>
                    <p>En Back Music te ofrecemos la posibilidad de vender tus instrumentos musicales de segunda mano.
                    Solo tienes que rellenar el siguiente formulario con los datos de tu producto y subir una imagen del mismo.
                    Una vez que hayas completado el formulario, tu producto en venta será revisado por nuestro equipo y en caso de ser aprobado,
                    aparecerá en nuestra página web para que otros usuarios puedan verlo y comprarlo.</p>
            EOS;
// Comprobamos que el usuario ha iniciado sesion
if (isset($_SESSION["login"])) {
    // Obtiene las ventas del usuario
    $ventas = $_SESSION['usuario']->getVentasUsuario();
    $contenido .= '<form action="ventaProducto.php"><button type="submit">Subir Producto</button></form>';

    if ($ventas == null) {
        $contenido .= "<p>No has subido ningun producto para su venta.</p>";
    } else {
        foreach ($ventas as $venta) {

            $contenido .= "<div class='producto'>";
            $contenido .= "<h2>" . $venta['Nombre'] . "</h2>";
            $contenido .= "<p>Precio : " . $venta['Precio'] . "</p>";
            $contenido .= "<p>Categoría : " . $venta['Categoria'] . "</p>";
            $contenido .= "<p>" . $venta['Descripcion'] . "</p>";
            $contenido .= "<p>Estado : " . $venta['Estado'] . "</p>";
            $contenido .= "<img src='" . RUTA_IMGS . '/imagenesBD/' . $venta['Imagen'] . "' alt='Imagen del producto'>";
            $contenido .= "<div id='botonesVenta'>";
            $ventaid = $venta['ID_Venta'];
            if ($venta['Estado'] == 'Pendiente') {
                $contenido .= "<button onclick='window.location.href=\"../helpers/procesarAceptacionVenta.php?venta=$ventaid\";'> Aceptar </button>";
                $contenido .= "<button onclick='window.location.href=\"../helpers/procesarAceptacionVenta.php?venta=-$ventaid\";'> Rechazar </button>";
                $contenido .= "<button> Editar </button>"; //pendiente de revisión
            }
            $contenido .= "</div>";
            $contenido .= "</div>";
        }
    }
} else {
    $contenido .= "<p>Debes iniciar sesión para ver tus ventas.</p>";
}
$contenido .= "</p> </section> </article> ";
require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
