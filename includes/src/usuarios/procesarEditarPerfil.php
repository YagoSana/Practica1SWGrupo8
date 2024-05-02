<?php
session_start();
require_once '../../config.php';
require_once 'usuario.php';

$viejouser = $_SESSION['ID'];
$Nombre = $_POST['Nombre'] ?? null;
$Apellido = $_POST['Apellido'] ?? null;
$Email = $_POST['Email'] ?? null;
$User = $_POST['User'] ?? null;
$Pass = $_POST['Pass'] ?? null;
$Rol = "cliente";
$Puntos = 0;

$query = Usuario::buscaUsuario($User);

if (!$query) {
    Usuario::editarUsuario($viejouser, $Nombre, $Apellido, $Email, $User, $Pass, $Rol, $Puntos);
    //hacer como logout
    session_destroy();
    $ruta = RUTA_IMGS;
    $titulo = 'Planificación de Back Music';
    $contenido = <<<EOS
        <article>
        <section>
            <h2>¡Tu perfil ha sido editado con éxito!</h2>
            <p>Ya puedes iniciar sesión con tus nuevos datos.</p>
        </section>
        </article>
        EOS;
        require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
        
}
else header('Location: ' . RUTA_APP . '/index.php');