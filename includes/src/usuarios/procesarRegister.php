<?php
session_start();
require_once '../../config.php';
use es\ucm\fdi\sw\src\usuarios\usuario;

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

header('Location: ' . RUTA_APP . '/index.php');