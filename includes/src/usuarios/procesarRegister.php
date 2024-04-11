<?php
session_start();
require_once '../../config.php';
require_once 'usuario.php';
require_once RAIZ_APP . '/includes/vistas/helpers/baseDatos.php';


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