<!DOCTYPE html>
<html>
    <nav id="lateralIzq">
        <ul>
        <li><a href="<?php echo RUTA_APP?>/index.php">Index</a></li>
        <li><a href="<?php echo RUTA_VISTAS?>/plantillas/principal.php">Principal</a></li>
        <li class="dropdown">
                <a href="<?php echo RUTA_VISTAS?>/plantillas/compras.php" class="dropdown-btn">Compras</a>
                <div class="dropdown-content">
                    <a href="<?php echo RUTA_VISTAS?>/plantillas/BuscarPorTipo.php?tipo=Viento">Viento</a>
                    <a href="<?php echo RUTA_VISTAS?>/plantillas/BuscarPorTipo.php?tipo=Cuerda">Cuerda</a>
                    <a href="<?php echo RUTA_VISTAS?>/plantillas/BuscarPorTipo.php?tipo=Percusion">Percusion</a>
                    <a href="<?php echo RUTA_VISTAS?>/plantillas/BuscarPorTipo.php?tipo=Articulos">Articulos</a>
                    <a href="<?php echo RUTA_VISTAS?>/plantillas/BuscarPorTipo.php?tipo=Todos">Todos</a>
                </div>
            </li>
        <li><a href="<?php echo RUTA_VISTAS?>/plantillas/mostrarVentas.php">Ventas</a></li>
        <li><a href="<?php echo RUTA_VISTAS?>/plantillas/contacto.php">Contacto</a></li>
        <li><a href="<?php echo RUTA_VISTAS?>/plantillas/detalles.php">Detalles</a></li>
        <li><a href="<?php echo RUTA_VISTAS?>/plantillas/miembros.php">Miembros</a></li>
        <li><a href="<?php echo RUTA_VISTAS?>/plantillas/bocetos.php">Bocetos</a></li>
        <li><a href="<?php echo RUTA_VISTAS?>/plantillas/planificacion.php">Planificación</a></li>
        <?php
            if(isset($_SESSION["esEmpleado"])) {
                echo '<li><a href="' . RUTA_VISTAS . '/plantillas/uploadProducto.php">Añadir productos</a></li>';
                echo '<li><a href="' . RUTA_VISTAS . '/plantillas/mostrarGestionVentas.php">Gestionar ventas</a></li>';
            }
        ?>

        </ul>
    </nav>
</html>
