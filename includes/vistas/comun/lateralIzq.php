
<!DOCTYPE html>
<html>
    <nav id="lateralIzq">
        <ul>
        <li><a href="<?php echo RUTA_APP?>/index.php">Index</a></li>
        <li><a href="<?php echo RUTA_VISTAS?>/plantillas/principal.php">Principal</a></li>
        <li><a href="<?php echo RUTA_VISTAS?>/plantillas/compras.php">Compras</a></li>
        <li><a href="<?php echo RUTA_VISTAS?>/plantillas/ventas.php">Ventas</a></li>
        <li><a href="<?php echo RUTA_VISTAS?>/plantillas/contacto.php">Contacto</a></li>
        <li><a href="<?php echo RUTA_VISTAS?>/plantillas/detalles.php">Detalles</a></li>
        <li><a href="<?php echo RUTA_VISTAS?>/plantillas/miembros.php">Miembros</a></li>
        <li><a href="<?php echo RUTA_VISTAS?>/plantillas/bocetos.php">Bocetos</a></li>
        <li><a href="<?php echo RUTA_VISTAS?>/plantillas/planificacion.php">Planificación</a></li>
        <?php
            if(isset($_SESSION["esEmpleado"])) {
                echo '<li><a href="' . RUTA_VISTAS . '/plantillas/uploadProducto.php">Añadir productos</a></li>';
            }
        ?>

        </ul>
    </nav>
</html>