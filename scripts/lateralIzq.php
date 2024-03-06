<!DOCTYPE html>
<html>
    <nav id="lateralIzq">
        <ul>
        <li><a href="../index.php">Index</a></li>
        <li><a href="../vistas/principal.php">Página principal</a></li>
        <li><a href="../SeccionCompras/compras.php">Sección de Compra</a></li>
        <li><a href="../SeccionVentas/ventas.php">Sección de Venta</a></li>
        <li><a href="../Valoraciones/valoraciones.php">Sección de Valoraciones</a></li>
        <li><a href="../vistas/contacto.php">Contacto</a></li>
        <li><a href="../vistas/detalles.php">Detalles</a></li>
        <li><a href="../vistas/miembros.php">Miembros</a></li>
        <li><a href="../vistas/bocetos.php">Bocetos</a></li>
        <li><a href="../vistas/planificacion.php">Planificación</a></li>
        <?php
        if(isset($_SESSION["esAdmin"])) {
            echo '<li><a href="../gestionArticulos/uploadArticulo.php">Añadir productos</a></li>';
        }
        ?>
        </ul>
    </nav>
</html>