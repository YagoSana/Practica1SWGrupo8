<?php
require '../../config.php';
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
                $pedido = $_SESSION['usuario']->getPedido(); // Asegúrate de que este método existe y devuelve un objeto de tipo Pedido
            
                // Muestra los pedidos
                $pedido->mostrarPedidos();
            } else {
                echo "<p>Debes iniciar sesión para ver tus pedidos.</p>";
            }
            ?>
        </main>
        <?php include RAIZ_APP . '/includes/vistas/comun/pieDePagina.php'; ?>
    </div>
</body>

</html>