<?php
// buscar.php
require_once ("../config.php");
include RAIZ_APP . '/includes/vistas/helpers/producto.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Asegúrate de que se ha enviado un término de búsqueda
if (!isset($_GET['q'])) {
    die("No se proporcionó ningún término de búsqueda.");
}

$busqueda = $_GET['q'];

// Aquí instancias tu clase Producto y obtienes todos los productos
$producto = new Producto(null, null, null, null, null, null,null, null, null);
$productos_data = $producto->getAllProductos();

// Filtra los productos que coinciden con la búsqueda
$resultados = array_filter($productos_data, function($producto) use ($busqueda) {
    return strpos(strtolower($producto['Nombre']), strtolower($busqueda)) !== false;
});
$ruta = RUTA_APP;
// Prepara el contenido para la plantilla
$contenido = '<h2>Compras Back Music</h2>
        <p>Esta el la sección de compras de Back Music. Aquí podrás encontrar todo lo que tenemos a la venta.</p>';
foreach ($resultados as $producto_data) {
    $producto = new Producto($producto_data['ID_Producto'], $producto_data['Nombre'], $producto_data['Descripcion'], $producto_data['Precio'], $producto_data['Imagen'], $producto_data['Stock'], $producto_data['Visible'], $producto_data['Tipo'], $producto_data['ID_Venta']);
    
        $reacondicionado = "(Nuevo)";
        if ($producto->esReacondicionado($producto)) { //revisa si el id de la venta es 0
            $reacondicionado = "(Reacondicionado)";
        }
        $visible = $producto->getVisible();
        if ($visible || isset($_SESSION["esEmpleado"])) {

            if ($visible) {
                $class = "producto";
            } else $class = "producto productoOculto";
            $rutaImagen = RUTA_APP . $producto->getImagen();
            $stock = $producto->getStock();
            $contenido .= <<<EOS
            <div class='$class' style='position: relative;'>
                <a class='subr' href='detalles_producto.php?id={$producto->getID()}'>
                <span class='stock'>Stock: $stock</span>
                <img src='$rutaImagen' alt='Imagen del producto' id='imgCompras'>

                    <div class ='detalles'>
                        <h3>{$producto->getNombre()}</h3>
                        <h4>$reacondicionado</h4>
                    </a>
                    <p>{$producto->getPrecio()} €</p>
                    <p>Tipo: {$producto->getTipo()}</p>
                </div>
                <div class='botones'>
            EOS;
            if (isset($_SESSION["login"])) {
                $contenido .= <<<EOS
                <form action='$ruta/includes/vistas/helpers/procesarCarrito.php' method='post'>
                    <input type='hidden' name='producto_id' value='{$producto->getID()}'>
                    <button class='agregar' type='submit' name='agregar_producto'>Agregar al carrito</button>
                </form>
                EOS;
            } else {

                $contenido .= <<<EOS
                <button class='agregar' onclick="window.location.href='$ruta/incudes/src/login.php'">Agregar al carrito</button>
                EOS;
            }

            if (isset($_SESSION["esEmpleado"]) && $visible) {
                $contenido .= <<<EOS
                <form action='$ruta/includes/vistas/helpers/procesarEliminacion.php' method='post'>
                    <input type='hidden' name='producto_id' value='{$producto->getID()}'>
                    <button class='borrar' type='submit' name='eliminar_producto'>Ocultar</button>
                </form>
                EOS;
            } else if (isset($_SESSION["esEmpleado"])) {
                $contenido .= <<<EOS
                <form action='$ruta/includes/vistas/helpers/procesarReabastecer.php' method='post'>
                    <input type='hidden' name='producto_id' value='{$producto->getID()}'>
                    <button class='reabastecer' type='submit' name='reabastecer_producto'>Reabastecer</button>
                </form>
                EOS;
            }

            $contenido .= "</div></div>";
        }
    }


// Muestra la plantilla con el contenido
$titulo = 'Compras Back Music';
require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
