<?php
require '../../config.php';
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include RAIZ_APP . '/includes/vistas/comun/header.php'; ?>
    <title>Ventas Back Music</title>
</head>

<body>
    <div id="contenedor">
        <?php include RAIZ_APP . '/includes/vistas/comun/cabecera.php'; ?>
        <?php include RAIZ_APP . '/includes/vistas/comun/lateralIzq.php'; ?>

        <main>
            <article>
                <section>
                    <h2>Administrar Ventas</h2>
                    <p>
                        Esta es la sección de administración de ventas. Aquí puedes aceptar o rechazar las ventas.
                        <?php
                            // Obtiene todas las ventas
                            $ventas = Venta::getAllVentas();

                            if($ventas == null) {
                                echo "<p>No hay ventas para mostrar.</p>";
                            } else {
                                foreach($ventas as $venta) {
                                    // Aquí puedes mostrar la información de cada venta
                                    echo "<p>" . $venta->Nombre . ": " . $venta->Descripcion . "</p>";
                                    echo "<p>Estado: " . $venta->Estado . "</p>";
                                    echo "<img src='" . $venta->Imagen . "' alt='Imagen del producto'>";
                                    echo '<form action="procesarAceptacionVenta.php" method="post">';
                                    echo '<input type="hidden" name="venta_id" value="' . $venta->ID . '">';
                                    echo '<input type="text" name="valor" placeholder="Introduce un valor">';
                                    echo '<button type="submit" name="accion" value="Aceptar">Aceptar</button>';
                                    echo '<button type="submit" name="accion" value="Rechazar">Rechazar</button>';
                                    echo '</form>';
                                }
                            }
                        ?>
                    </p>
                </section>
            </article>
        </main>
        <?php include RAIZ_APP . '/includes/vistas/comun/pieDePagina.php'; ?>
    </div>
</body>

</html>