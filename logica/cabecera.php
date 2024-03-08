<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html>
    <header>
        <div id="divSuperior">
            <img src='../img/backMusicLogo.png' class="logoCabecera">
            <h1 class="h1titulo">BACK MUSIC</h1>
            <h2>La mejor tienda de música</h2>
        </div>
        <div id="divInferior">
        <?php
            if (isset($_SESSION["login"])) {                
                echo "Usuario registrado: ".$_SESSION["nombre"].". <a href='../logica/logout.php'>Logout</a>";
            } else {
                echo "Usuario desconocido. <a href='../vistas/login.php'>Login</a>";
            }
            
            echo "<a href='../vistas/mostrarCarrito.php' class='carrito'>TU CARRITO</a>";
        ?>
        </div>
	</header>
</html>