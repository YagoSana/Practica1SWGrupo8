<?php
require '../../config.php';
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$titulo = 'Ventas Back Music';
$contenido = <<<EOS
            <article>
                <section>
                    <h2>Ventas Back Music</h2>
                    <p>
                        Esta el la sección de ventas de Back Music. Aquí podrás encontrar si tus productos han sido
                        rechazados o aceptados a cambio de BMPoints para su Wallet virtual de la tienda.
            EOS;
                // Comprobamos que el usuario ha iniciado sesion
                if (isset($_SESSION["login"])) {
                    // Obtiene las ventas del usuario
                    $ventas = $_SESSION['usuario']->getVentasUsuario();
                    $contenido .= '<form action="ventaProducto.php"><button type="submit">Subir Producto</button></form>';
                    
                    if($ventas == null) {
                        $contenido .= "<p>No has subido ningun producto para su venta.</p>";
                    } else {
                        foreach($ventas as $venta) {
                            // Aquí puedes mostrar la información de cada venta
                            $contenido .= "<div class='producto'>";
                            $contenido .= "<p>" . $venta['Nombre'] . ": " . $venta['Descripcion'] . "</p>";
                            $contenido .= "<p>Estado: " . $venta['Estado'] . "</p>";
                            $contenido .= "<img src='". RUTA_IMGS . '/imagenesBD/'.$venta['Imagen'] . "' alt='Imagen del producto'>";
                            $contenido .= "</div>";
                        }
                    }                            
                } else {
                    $contenido .= "<p>Debes iniciar sesión para ver tus ventas.</p>";
                }
        $contenido .= "</p> </section> </article> ";
require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';