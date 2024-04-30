<?php
require '../../config.php';
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include RAIZ_APP . '/includes/vistas/comun/header.php'; ?>
    <title>Carrito Back Music</title>
</head>

<body>
    <div id="contenedor">
        <?php include RAIZ_APP . '/includes/vistas/comun/cabecera.php'; ?>
        <?php include RAIZ_APP . '/includes/vistas/comun/lateralIzq.php'; ?>
        <main>
            <?php
            // Comprobamos que el usuario ha iniciado sesion
            if (isset($_SESSION['login'])) {
                // Obtiene el carrito de compras del usuario
                $carrito = $_SESSION['usuario']->getCarrito(); 
                
                // Muestra los productos en el carrito
                $carrito->mostrarProductos();
            } else {
                echo "<p>Debes iniciar sesión para ver tu carrito de compras.</p>";
            }
            ?>
        </main>
        <?php include RAIZ_APP . '/includes/vistas/comun/pieDePagina.php'; ?>
    </div>
</body>

</html>