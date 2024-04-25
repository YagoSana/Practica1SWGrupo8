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
                    <h2>Ventas Back Music</h2>
                    <p>
                        Esta el la sección de ventas de Back Music. Aquí podrás encontrar si tus productos han sido
                        rechazados o aceptados a cambio de BMPoints para su Wallet virtual de la tienda.
                        <?php
                            // Comprobamos que el usuario ha iniciado sesion
                            if (isset($_SESSION['login'])) {
                                // Obtiene las ventas del usuario
                                $ventas = $_SESSION['usuario']->getVentasUsuario();
                                echo '<form action="ventaProducto.php"><button type="submit">Subir Producto</button></form>';
                                
                                if($ventas == null) {
                                    echo "<p>No has subido ningun producto para su venta.</p>";
                                } else {
                                    foreach($ventas as $venta) {
                                        // Aquí puedes mostrar la información de cada venta
                                        echo "<p>" . $venta['Nombre'] . ": " . $venta['Descripcion'] . "</p>";
                                        echo "<p>Estado: " . $venta['Estado'] . "</p>";
                                        echo "<img src='". RUTA_IMGS . '/imagenesBD/'.$venta['Imagen'] . "' alt='Imagen del producto'>";
                                        
                                    }
                                }

                                
                            
                            } else {
                                echo "<p>Debes iniciar sesión para ver tus ventas.</p>";
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
