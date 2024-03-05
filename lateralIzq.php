<!DOCTYPE html>
<html>
    <nav id="lateralIzq">
        <ul>
        <li><a href="../index.php">Index</a></li>
        <li><a href="../principal.php">Página principal</a></li>
        <li><a href="../SeccionCompras/compras.php">Sección de Compra</a></li>
        <li><a href="../SeccionVentas/ventas.php">Sección de Venta</a></li>
        <li><a href="../Valoraciones/valoraciones.php">Sección de Valoraciones</a></li>
        <li><a href="../contacto.php">Contacto</a></li>
        <li><a href="../detalles.php">Detalles</a></li>
        <li><a href="../miembros.php">Miembros</a></li>
        <li><a href="../bocetos.php">Bocetos</a></li>
        <li><a href="../planificacion.php">Planificación</a></li>
        <?php
        if(isset($_SESSION["esAdmin"])) {
            echo '<li><a href="../uploadArticulo.php">Añadir productos</a></li>';
        }
        ?>
        </ul>
    </nav>
</html>