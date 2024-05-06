<?php
require '../../config.php';
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';
require_once '../helpers/pedido.php';
require_once '../helpers/producto.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include RAIZ_APP . '/includes/vistas/comun/header.php'; ?>
    <title>Sistema de Valoracion BACK MUSIC</title>
</head>

<body>
    <div id="contenedor">
        <?php include RAIZ_APP . '/includes/vistas/comun/cabecera.php'; ?>
        <?php include RAIZ_APP . '/includes/vistas/comun/lateralIzq.php'; ?>
        <main>
            <h2>Valore nuestro producto :D</h2>
            <?php
                $id_pedido = $_GET['id'];
                $pedido = new Pedido($_SESSION['usuario']);
                $productos = Pedido::obtenerProductosDelPedido($id_pedido);
                foreach($productos as $producto) {
                    $prod = Producto::getProducto($producto['ID_Producto']);
                    echo $prod->getNombre();
                    if($pedido->yaValorado($id_pedido, $producto['ID_Producto'])) {
            ?>
            <div class='pedido'>
            <form action="<?php echo RUTA_APP; ?>/includes/vistas/helpers/procesarValoracion.php" method="POST">
                <input type="hidden" name="pedido_id" value="<?php echo $id_pedido ?>">
                <input type="hidden" name="producto_id" value="<?php echo $producto['ID_Producto'] ?>">
                <label>
                    <input type="radio" name="valoracion" value="1"> 1
                </label>
                <label>
                    <input type="radio" name="valoracion" value="2"> 2
                </label>
                <label>
                    <input type="radio" name="valoracion" value="3"> 3
                </label>
                <label>
                    <input type="radio" name="valoracion" value="4"> 4
                </label>
                <label>
                    <input type="radio" name="valoracion" value="5"> 5
                </label>
                <textarea name="comentario" minlength="50" maxlength="1500" required></textarea>
                <input type="submit" value="Enviar valoración">
            </form>
                </div>
            <?php
                    }else {
                        echo "<div class='pedido'>";
                        echo "<p class='frase'>Ya has valorado este producto.</p>";
                        echo "</div>";
                    }
                }
            ?>
            <button class='valorar-btn' onclick="window.location.href='<?php echo RUTA_APP; ?>/includes/vistas/plantillas/mostrarPedidos.php'">Volver</button>
        </main>
        <?php include RAIZ_APP . '/includes/vistas/comun/pieDePagina.php'; ?>
    </div>
</body>

</html>