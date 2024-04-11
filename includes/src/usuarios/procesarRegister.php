<?php
session_start();
require_once '../../config.php';
require_once 'usuario.php';

$db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);
$db->connect();

$Nombre = $_POST['Nombre'] ?? null;
$Apellido = $_POST['Apellido'] ?? null;
$Email = $_POST['Email'] ?? null;
$User = $_POST['User'] ?? null;
$Pass = $_POST['Pass'] ?? null;
$rol = "cliente";

$query = Usuario::buscaUsuario($User);

if (!$query) {
    Usuario::insertaUsuario($Nombre, $Apellido, $Email, $User, $Pass, $rol);
}


$db->close();
header('Location: ' . RUTA_APP . '/index.php');
?>