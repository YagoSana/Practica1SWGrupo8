<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION["login"])) {
        require_once RAIZ_APP . '/includes/src/usuarios/usuario.php';
        $usuario = Usuario::buscaUsuario($_SESSION["nombre"]);
    }
?>
<!DOCTYPE html>
<html>
    <link rel="icon" href="<?php echo RUTA_IMGS?>/simpleLogo.png">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS?>/estilos.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</html>