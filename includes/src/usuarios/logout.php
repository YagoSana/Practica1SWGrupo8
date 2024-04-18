<?php
require_once '../../config.php';
session_start();
session_destroy();
header('Location: '.RUTA_APP.'/index.php');
exit;
?>
