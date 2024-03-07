<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("../logica/header.php"); ?>
        <title>Login Back Music</title>
    </head>  
    <body>
        <div id="contenedor">
            <?php include("../logica/cabecera.php"); ?>
            <?php include("../logica/lateralIzq.php"); ?>

            <main>
                <?php
                // Comprobamos que el usuario ha iniciado sesion
                if (isset($_SESSION['usuario'])) {
                    // Obtiene el carrito de compras del usuario
                    $carrito = $_SESSION['usuario']->getCarrito();

                    // Muestra los productos en el carrito
                    $carrito->mostrarProductos();
                } else {
                    echo "Debes iniciar sesión para ver tu carrito de compras.";
                }
                ?>
            </main>

            <?php include("../logica/pieDePagina.php"); ?>
        </div>
    </body>
</html>