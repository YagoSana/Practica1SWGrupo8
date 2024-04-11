<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<header>
    <div id="divSuperior">
        <img src="<?php echo RUTA_IMGS ?>/backMusicLogo.png" class="logoCabecera">
        <h1 class="h1titulo">BACK MUSIC</h1>
        <h2>La mejor tienda de música</h2>
    </div>
    <div id="divInferior">
        <?php
        if (isset($_SESSION["login"])) {
            echo "Usuario registrado: " . $_SESSION["nombre"] . ". <a href=" . RUTA_SRC . "/Usuarios/logout.php>Logout</a>";
        } else {
            echo "Usuario desconocido. <a href=" . RUTA_SRC . "/login.php>Login</a>";
        }
        ?>
        <a href="<?php echo RUTA_VISTAS ?>/plantillas/mostrarCarrito.php" class='Carrito'>CARRITO</a>
        <span class="Carrito"> | </span>
        <a href="<?php echo RUTA_VISTAS ?>/plantillas/mostrarPedidos.php" class='Carrito'>PEDIDOS</a>
    </div>
</header>

</html>