<!DOCTYPE html>
<html lang="es">
    <head>
        <?php 
            include("../comun/header.php");
            include("../comun/usuario.php");
        ?>
        <title>Login Back Music</title>
    </head>  
    <body>
        <div id="contenedor">
            <?php include("../comun/cabecera.php"); ?>
            <?php include("../comun/lateralIzq.php"); ?>

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

            <?php include("../comun/pieDePagina.php"); ?>
        </div>
    </body>
</html>