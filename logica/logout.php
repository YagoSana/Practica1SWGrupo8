<?php
session_start();
session_destroy();
header('Location: '.RUTA_APP.'/index.php');
exit;
?>
