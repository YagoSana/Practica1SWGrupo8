<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION["login"])) {
    require_once RAIZ_APP . '/includes/src/usuarios/usuario.php';
    $usuario = Usuario::buscaUsuario($_SESSION["nombre"]);
}
$puntos = 0;
?>
<!DOCTYPE html>
<html>
<header>
    <div id="divSuperior">
        <img src="<?php echo RUTA_IMGS ?>/backMusicLogo.png" class="logoCabecera">
        <h1 class="h1titulo">BACK MUSIC</h1>
        <h2>La mejor tienda de música</h2>
        <div class="cabecera">
            <!-- Aquí agregamos el formulario de búsqueda -->
            <form action="<?php echo RUTA_SRC ?>/buscar.php" method="get">
                <input type="text" name="q" class="buscador" placeholder="Buscar...">

            </form>
        </div>
    </div>
    <div id="divInferior">
        <div id="divlogin">
            <?php
            if (isset($_SESSION["login"])) {
                echo "<p>Bienvenido: " . $_SESSION["nombre"] . "</p> 
                <div class='buttoncabecera'>
                    <form action='" . RUTA_SRC . "/editarPerfil.php' method='post'>
                        <button type='submit' name='edit_profile'>Editar perfil</button>
                    </form> 
                    <form action='" . RUTA_SRC . "/usuarios/logout.php' method='post'>
                        <button type='submit' name='logout'>Logout</button>
                    </form>
                </div>
                </p>";
                $puntos = Usuario::getPuntos($usuario->getId());
                echo "<p>Tus puntos en el wallet: $puntos p.</p>";
            } else {
                echo "<p>Usuario no registrado.</p>
                <div class='buttoncabecera'>
                    <form action='" . RUTA_SRC . "/login.php' method='post'>
                        <button type='submit' name='login'>Login</button>
                    </form>
                </div>";
            }
            ?>
        </div>
        <div id="divarticulos">
            <div id="divpedido">
                <a href="<?php echo RUTA_VISTAS ?>/plantillas/mostrarPedidos.php"><img src="<?php echo RUTA_IMGS ?>/PEDIDO.png" alt="Pedido"></a>
                <p>Pedidos</p>
            </div>
            <div id="divcarrito">
                <a href="<?php echo RUTA_VISTAS ?>/plantillas/mostrarCarrito.php"><img src="<?php echo RUTA_IMGS ?>/carrito.png" alt="Carrito"></a>
                <p>Carrito</p>
            </div>
        </div>
    </div>
</header>

</html>