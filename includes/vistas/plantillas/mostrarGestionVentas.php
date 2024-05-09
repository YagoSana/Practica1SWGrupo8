<?php
require '../../config.php';
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';
require_once RAIZ_APP. '/includes/vistas/helpers/venta.php';
require_once '../../FormularioEditarVenta.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$titulo = 'Gestión entas Back Music';
$contenido = <<<EOS
            <article>
                <section>
            EOS;
// Comprobamos que el usuario ha iniciado sesion
if (isset($_SESSION["login"])) {
    // Obtiene las ventas del usuario
    $ventas = Venta::getAllVentas();
    $contenido .= '<form action="ventaProducto.php"><button type="submit">Subir Producto</button></form>';

    if ($ventas == null) {
        $contenido .= "<p>No has subido ningun producto para su venta.</p>";
    } else {
        foreach ($ventas as $venta) {
            if ($venta['Estado'] == "Pendiente"){
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
                $contenido .= "<button onclick='window.location.href=\"mostrarEditarVenta.php?ventaid=$ventaid\";'> Editar </button>";
            }
            $contenido .= "</div>";
            $contenido .= "</div>";
        }
        }
    }
} else {
    $contenido .= "<p>Debes iniciar sesión para ver tus ventas.</p>";
}
$contenido .= "</p> </section> </article> ";
require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';



/*


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

/*$contenido .= "<div id='botonesVenta'>";
            $ventaid = $venta['ID_Venta'];
            if ($venta['Estado'] == 'Pendiente') {
                $contenido .= "<button onclick='window.location.href=\"../helpers/procesarAceptacionVenta.php?venta=$ventaid\";'> Aceptar </button>";
                $contenido .= "<button onclick='window.location.href=\"../helpers/procesarAceptacionVenta.php?venta=-$ventaid\";'> Rechazar </button>";
                $contenido .= "<button> Editar </button>"; //pendiente de revisión
            }
            $contenido .= "</div>";
            */