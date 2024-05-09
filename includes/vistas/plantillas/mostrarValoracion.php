<?php
    require '../../config.php';
    require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';
    require_once '../helpers/pedido.php';
    require_once '../helpers/producto.php';
    require_once '../../FormularioValoracion.php';
    session_start();

    $titulo = "Valorar productos";
    $htmlFormVal = "";
    $id_pedido = $_GET['id'];
    $pedido = new Pedido($_SESSION['usuario']);
    $productos = Pedido::obtenerProductosDelPedido($id_pedido);

    foreach($productos as $producto) {
        $prod = Producto::getProducto($producto['ID_Producto']);
        $htmlFormVal .= "<div class='nom'>" . $prod->getNombre() . "</div>";

        if($pedido->yaValorado($id_pedido, $producto['ID_Producto'])) {

            $form = new FormularioValoracion($id_pedido, $producto['ID_Producto']);       
            $htmlFormVal .= $form->gestiona();
        
        }else {

            $htmlFormVal .= "<div class='val'><p>¡Ya has valorado este producto!</p></div>";
        }
    }

    $botonVolver = "<button class='volver-btn' onclick=\"window.location.href='" . RUTA_APP . "/includes/vistas/plantillas/mostrarPedidos.php'\">Volver</button>";

    $contenido = <<<EOS
    $htmlFormVal
    $botonVolver
    EOS;


    require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
?>
