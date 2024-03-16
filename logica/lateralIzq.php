<?php 
require_once 'config.php';
?>
<!DOCTYPE html>
<html>
    <nav id="lateralIzq">
        <ul>
        <li><a href="<?php echo RUTA_APP?>/index.php">Index</a></li>
        <li><a href="<?php echo RUTA_APP?>/vistas/principal.php">Página principal</a></li>
        <li><a href="<?php echo RUTA_APP?>/vistas/compras.php">Sección de Compra</a></li>
        <li><a href="<?php echo RUTA_APP?>/vistas/ventas.php">Sección de Venta</a></li>
        <li><a href="<?php echo RUTA_APP?>/vistas/valoraciones.php">Sección de Valoraciones</a></li>
        <li><a href="<?php echo RUTA_APP?>/vistas/contacto.php">Contacto</a></li>
        <li><a href="<?php echo RUTA_APP?>/vistas/detalles.php">Detalles</a></li>
        <li><a href="<?php echo RUTA_APP?>/vistas/miembros.php">Miembros</a></li>
        <li><a href="<?php echo RUTA_APP?>/vistas/bocetos.php">Bocetos</a></li>
        <li><a href="<?php echo RUTA_APP?>/vistas/planificacion.php">Planificación</a></li>
        <?php
            if(isset($_SESSION["esAdmin"])) {
                echo '<li><a href="' . RUTA_APP . '/vistas/uploadProducto.php">Añadir productos</a></li>';
                echo '<li><a href="' . RUTA_APP . '/vistas/eliminarProducto.php">Eliminar productos</a></li>';
            }
        ?>

        </ul>
    </nav>
</html>