<?php
session_start();
require_once '../../config.php';
require_once 'usuario.php';
require_once RAIZ_APP . '/includes/vistas/helpers/baseDatos.php';

$db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);
$db->connect();

$Nombre = $_POST['Nombre'] ?? null;
$Apellido = $_POST['Apellido'] ?? null;
$Email = $_POST['Email'] ?? null;
$User = $_POST['User'] ?? null;
$Pass = $_POST['Pass'] ?? null;
$rol = "cliente";

if ($User) {
    $query = Usuario::buscaUsuario($User);
    if (!empty($query)) {
        $result = $db->getConnection()->query($query);
        if ($result->rowcount() == 0 && $Nombre && $Apellido && $Email && $Pass && $rol) {
            
            $hashedPass = Usuario::hashPassword($Pass);
            $usuario = Usuario::crea($User, $hashedPass, $Nombre, $rol);
            if ($usuario) {
                define('REGISTRADO', true);
                $_SESSION["nombre"] = $User;
                //insertar en la bd
                $db->getConnection()->query($usuario->insertarUsuario($Nombre, $Apellido, $Email, $User, $Pass, $rol));
            }
        }
    }
}

$db->close();
header('Location: ' . RUTA_APP . '/index.php');