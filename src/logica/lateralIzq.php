<!DOCTYPE html>
<html>
    <nav id="lateralIzq">
        <ul>
        <li><a href="../index.php">Index</a></li>
        <li><a href="../src/vistas/principal.php">Página principal</a></li>
        <li><a href="../src/vistas/compras.php">Sección de Compra</a></li>
        <li><a href="../src/vistas/ventas.php">Sección de Venta</a></li>
        <li><a href="../src/vistas/valoraciones.php">Sección de Valoraciones</a></li>
        <li><a href="../src/vistas/contacto.php">Contacto</a></li>
        <li><a href="../src/vistas/detalles.php">Detalles</a></li>
        <li><a href="../src/vistas/miembros.php">Miembros</a></li>
        <li><a href="../src/vistas/bocetos.php">Bocetos</a></li>
        <li><a href="../src/vistas/planificacion.php">Planificación</a></li>
        <?php
        if(isset($_SESSION["esAdmin"])) {
            echo '<li><a href="../src/vistas/uploadArticulo.php">Añadir productos</a></li>';
        }
        ?>
        </ul>
    </nav>
</html>