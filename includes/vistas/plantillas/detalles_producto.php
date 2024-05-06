<?php
require ("../../config.php");
require_once ("../helpers/producto.php");
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';

$producto_id = $_GET['id'];
$producto = Producto::getProducto($producto_id);

$titulo  = "Detalles del producto";
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
                <?php
                $id_producto = $producto->getID();
                $valoraciones = valoracion::getValoracion($id_producto);
                foreach($valoraciones as $valoracion) {
                    
                    if($valoracion != null) {
                        
                        $usuario = Usuario::buscaPorId($valoracion["Idusuario"]);
                
                ?>
                    <div class='valoracion'>
                        <p>Usuario: <?php echo $usuario->getNombre(); ?></p>
                        <p>Valoración: <?php echo $valoracion['Valoracion']; ?></p>
                        <p>Comentario: <?php echo $valoracion['Comentario']; ?></p>
                    </div>
                <?php } }?>
            </div>
        </div>
    </section>
</article>
<?php
$contenido = ob_get_clean();
require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
?>
