<?php

require_once __DIR__.'/Formulario.php';
require_once 'config.php';
require_once __DIR__.'/src/usuarios/usuario.php';

class FormularioRegister extends Formulario
{
    public function __construct() {
        parent::__construct('formRegistro', ['urlRedireccion' => RUTA_APP . '/index.php']);
    }
    
    protected function generaCamposFormulario(&$datos)
{
    $nombreUsuario = $datos['username'] ?? '';
    $nombre = $datos['nombre'] ?? '';
    $apellido = $datos['apellido'] ?? '';
    $email = $datos['email'] ?? '';

    $erroresCampos = self::generaErroresCampos(['username', 'nombre', 'apellido', 'email', 'password'], $this->errores, 'span', array('class' => 'error'));

    $contenido = <<<EOS
        <h2>Registro de usuario</h2>
        <fieldset>
            <legend>Datos de usuario</legend>
            <div>
                <label for="username">Nombre de usuario:</label>
                <input id="username" type="text" name="username" value="$nombreUsuario" required />
                {$erroresCampos['username']}
            </div>
            <div>
                <label for="nombre">Nombre:</label>
                <input id="nombre" type="text" name="nombre" value="$nombre" required />
                {$erroresCampos['nombre']}
            </div>
            <div>
                <label for="apellido">Apellido:</label>
                <input id="apellido" type="text" name="apellido" value="$apellido" required />
                {$erroresCampos['apellido']}
            </div>
            <div>
                <label for="email">Email:</label>
                <input id="email" type="email" name="email" value="$email" required />
                {$erroresCampos['email']}
            </div>
            <div>
                <label for="password">Password:</label>
                <input id="password" type="password" name="password" required />
                {$erroresCampos['password']}
            </div>
            <div>
                <input type="submit" value="Registrarse">
            </div>
        </fieldset>
    EOS;

    return $contenido;
}

protected function procesaFormulario(&$datos){
        $this->errores = [];
        $nombreUsuario = trim($datos['username'] ?? '');
        $nombre = trim($datos['nombre'] ?? ''); 
        $apellido = trim($datos['apellido'] ?? ''); 
        $email = trim($datos['email'] ?? '');
        $password = trim($datos['password'] ?? '');

        if (empty($nombreUsuario)) {
            $this->errores['username'] = 'Por favor, introduce un nombre de usuario.';
        }

        if (empty($nombre)) {
            $this->errores['nombre'] = 'Por favor, introduce tu nombre.';
        }

        if (empty($apellido)) {
            $this->errores['apellido'] = 'Por favor, introduce tu apellido.';
        }

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errores['email'] = 'Por favor, introduce un email válido.';
        }

        if (empty($password)) {
            $this->errores['password'] = 'Por favor, introduce una contraseña.';
        }

        if (count($this->errores) === 0) {
            $Rol = "cliente";
            $Puntos = 0;
            $query = Usuario::buscaUsuario($nombreUsuario);
            if (!$query) {
                Usuario::insertaUsuario($nombre, $apellido, $email, $nombreUsuario, $password, $Rol, $Puntos);
            } else {
                $this->errores[] = 'El nombre de usuario ya está en uso.';
            }
        }
    }


}
?>

