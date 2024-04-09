<?php
require '../../config.php';
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';
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
            // Comprobamos que el usuario ha iniciado sesion
            if (isset($_SESSION['login'])) {
                // Obtiene los pedidos del usuario
                $carrito = $_SESSION['usuario']->getCarrito();
                $pedido = $carrito->getPedido(); //Devuelve el pedido
                
                if($pedido != null){
                    // Muestra los pedidos
                    if($pedido->getCliente() == null) {
                        $usu = $_SESSION['usuario'];
                        $pedido->setCliente($usu);
                    }
                    
                    $pedido->mostrarPedidos();
                }
                else {
                    
                    echo "<p>No existen pedidos.</p>";
                }
                
            } else {
                echo "<p>Debes iniciar sesión para ver tus pedidos.</p>";
            }
            ?>
        </main>
        <?php include RAIZ_APP . '/includes/vistas/comun/pieDePagina.php'; ?>
    </div>
</body>

</html>