<?php
    require_once '../logica/config.php';
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php 
            include(RUTA_APP ."/logica/header.php");
            include(RUTA_APP ."/logica/usuario.php");
        ?>
        <title>Login Back Music</title>
    </head>  
    <body>
        <div id="contenedor">
            <?php include(RUTA_APP ."/logica/cabecera.php"); ?>
            <?php include(RUTA_APP ."/logica/lateralIzq.php"); ?>

            <main>
                <?php
                // Comprobamos que el usuario ha iniciado sesion
                if (isset($_SESSION['login'])) {
                    // Obtiene el carrito de compras del usuario
                    $carrito = $_SESSION['usuario']->getCarrito(); //!!!!!Hay que cambiar esto a user no puede ser el la busqueda por el nombre¡¡¡¡¡¡ Tiene que devolver un objeto de tipo usuario

                    // Muestra los productos en el carrito
                    $carrito->mostrarProductos();
                } else {
                    echo "Debes iniciar sesión para ver tu carrito de compras.";
                }
                ?>
            </main>

            <?php include(RUTA_APP ."/logica/pieDePagina.php"); ?>
        </div>
    </body>
</html>