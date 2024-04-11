<?php
// Incluye el archivo de la clase Database, Usuario y Producto
require ("../../config.php");
use es\ucm\fdi\sw\vistas\helpers\producto;
use es\ucm\fdi\sw\usuarios\usuario;
use es\ucm\fdi\sw\vistas\helpers\valoracion;

// Obtiene el ID del producto de la URL
$producto_id = $_GET['id'];

// Usa el método getProducto de la clase Producto para obtener los detalles del producto
$producto = Producto::getProducto($producto_id);

// Usa el método getValoracion para obtener las valoraciones del producto
$valoraciones = valoracion::getValoracion($producto_id);
$ruta = RUTA_APP;

ob_start();
?>
<article>
    <section>
        <h2>Detalles del producto</h2>
        <div class='detalle_producto'>
            <img src='<?php echo $ruta . $producto->getImagen(); ?>' alt='Imagen del producto'>
            <div>
                <h3><?php echo $producto->getNombre(); ?></h3>
                <p><?php echo $producto->getDescripcion(); ?></p>
                <h4>Valoraciones</h4>
                <?php foreach ($valoraciones as $valoracion) { 
                    $usuario = Usuario::buscaPorId($valoracion["Idusuario"]);
                ?>
                    <div class='valoracion'>
                        <p>Usuario: <?php echo $usuario->getNombre(); ?></p>
                        <p>Valoración: <?php echo $valoracion['Valoracion']; ?></p>
                        <p>Comentario: <?php echo $valoracion['Comentario']; ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</article>
<?php
$contenido = ob_get_clean();
require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
?>
