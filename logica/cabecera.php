<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html>
    <header>
        <h1>BACK MUSIC</h1>
        <?php
            if (isset($_SESSION["login"])) {                
                echo "Usuario registrado: ".$_SESSION["nombre"].". <a href='../logica/logout.php'>Logout</a>";
            } else {
                echo "Usuario desconocido. <a href='../vistas/login.php'>Login</a>";
            }

            echo "<a href='../vistas/mostrarCarrito.php' class='carrito'>CARRITO</a>";
        ?>
	</header>
</html>