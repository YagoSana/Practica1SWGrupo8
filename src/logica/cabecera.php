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
                echo "Usuario registrado: ".$_SESSION["nombre"].". <a href='../src/logica/logout.php'>Logout</a>";
            } else {
                echo "Usuario desconocido. <a href='../src/vistas/login.php'>Login</a>";
            }
        ?>
	</header>
</html>