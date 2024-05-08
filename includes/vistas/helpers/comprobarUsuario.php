<?php
require '../../config.php';
require_once __DIR__.'/../../src/usuarios/usuario.php';


$user = $_REQUEST['user'];
$resultado = Usuario::buscaUsuario($user);

if ($resultado !== false) {
    echo "existe";
} else {
    echo "disponible";
}
?>