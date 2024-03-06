<!DOCTYPE html>
<html>
    <header>
        <h1>BACK MUSIC</h1>
        <?php
            if (isset($_SESSION["login"])) {                
                echo "Usuario registrado: ".$_SESSION["nombre"].". <a href='../login/logout.php'>Logout</a>";
            } else {
                echo "Usuario desconocido. <a href='../login/login.php'>Login</a>";
            }
        ?>
	</header>
</html>