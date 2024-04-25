<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION["login"])){
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
            echo "<p>Usuario registrado: " . $_SESSION["nombre"] . ". <a href=" . RUTA_SRC . "/usuarios/logout.php>Logout</a></p>";
            $puntos = Usuario::getPuntos($usuario);
            echo "<p>Tus puntos en el wallet: $puntos p.</p>";
        } else {
            echo "<p>Usuario desconocido. <a href=" . RUTA_SRC . "/login.php>Login</a></p>";
        }
        ?>
        </div>
        <div id="divcarrito">
            <a href="<?php echo RUTA_VISTAS ?>/plantillas/mostrarCarrito.php" class='carrito'>CARRITO</a>
            <span class="carrito"> | </span>
            <a href="<?php echo RUTA_VISTAS ?>/plantillas/mostrarPedidos.php" class='carrito'>PEDIDOS</a>
        </div>
    </div>
</header>
</html>
