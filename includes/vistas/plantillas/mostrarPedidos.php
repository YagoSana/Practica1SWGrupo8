<?php
require '../../config.php';
//require_once RAIZ_APP. '/includes/src/Usuarios/Usuario.php';
use es\ucm\fdi\sw\usuarios\Usuario;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include RAIZ_APP . '/includes/vistas/comun/header.php'; ?>
    <title>Mostrar Pedidos</title>
</head>

<body>
    <div id="contenedor">
        <?php include RAIZ_APP . '/includes/vistas/comun/cabecera.php'; ?>
        <?php include RAIZ_APP . '/includes/vistas/comun/lateralIzq.php'; ?>
        <main>
            <?php
            // Comprobamos que el Usuario ha iniciado sesion
            if (isset($_SESSION['login'])) {
                // Obtiene los Pedidos del Usuario
                $Carrito = $_SESSION['usuario']->getCarrito();
                $Pedido = $Carrito->getPedido(); //Devuelve el Pedido del Usuario

                if($Pedido == null) {
                    $Pedido = new Pedido($_SESSION['usuario']);
                }
                    
                $Pedido->mostrarPedidos();
              
            } else {
                echo "<p>Debes iniciar sesión para ver tus Pedidos.</p>";
            }
            ?>
        </main>
        <?php include RAIZ_APP . '/includes/vistas/comun/pieDePagina.php'; ?>
    </div>
</body>

</html>