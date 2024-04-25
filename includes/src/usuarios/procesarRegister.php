<?php
session_start();
require_once '../../config.php';
require_once 'usuario.php';

$Nombre = $_POST['Nombre'] ?? null;
$Apellido = $_POST['Apellido'] ?? null;
$Email = $_POST['Email'] ?? null;
$User = $_POST['User'] ?? null;
$Pass = $_POST['Pass'] ?? null;
$Rol = "cliente";
$Puntos = 0;

$query = Usuario::buscaUsuario($User);

if (!$query) {
    Usuario::insertaUsuario($Nombre, $Apellido, $Email, $User, $Pass, $Rol, $Puntos);
}

header('Location: ' . RUTA_APP . '/index.php');