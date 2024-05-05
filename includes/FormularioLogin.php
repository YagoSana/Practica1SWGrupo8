<?php
require_once __DIR__.'/Formulario.php';
require_once 'config.php';
require_once __DIR__.'/src/usuarios/usuario.php';

class FormularioLogin extends Formulario
{
    public function __construct() {
        parent::__construct('formLogin', ['urlRedireccion' => RUTA_APP . '/index.php']);
    }
    
    protected function generaCamposFormulario(&$datos)
    {
        // Se reutiliza el nombre de usuario introducido previamente o se deja en blanco
        $nombreUsuario = $datos['username'] ?? '';
        $password = $datos['password'] ?? '';

        // Se generan los mensajes de error si existen.
        $erroresCampos = self::generaErroresCampos(['username', 'password'], $this->errores, 'span', array('class' => 'error'));
        $linkRegistro = RUTA_APP . '/includes/src/register.php';


        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $htmlCamposFormulario = <<<EOS
        <fieldset class='claseFormulario'>
            <div>
                <label for="username">Nombre de usuario :</label>
                <input id="username" type="text" name="username" value="$nombreUsuario" />
                {$erroresCampos['username']}
            </div>
            <div>
                <label for="password">Contraseña :</label>
                <input id="password" type="password" name="password" />
                {$erroresCampos['password']}
            </div>
            <div id='botonLogin'>
                <input type="submit" value="Login">
            </div>
            <p>¿No tienes cuenta en nuestra web?</p>
           
            <p>Regístrate como un nuevo Usuario <a href="$linkRegistro">aquí</a></p>

        </fieldset>
        EOS;

        return $htmlCamposFormulario;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];
        $nombreUsuario = trim($datos['username'] ?? '');
        $password = trim($datos['password'] ?? '');

        // Validación de campos
        if (empty($nombreUsuario)) {
            $this->errores['username'] = 'El nombre de usuario no puede estar vacío';
        }
        if (empty($password)) {
            $this->errores['password'] = 'El password no puede estar vacío.';
        }

        // Procesamiento de formulario
        if (count($this->errores) === 0) {
            $usuario = Usuario::login($nombreUsuario, $password);

            if (!$usuario) {
                $this->errores[] = "El usuario o el password no coinciden";
            } else {
                session_start();
                $_SESSION["login"] = true;
                $_SESSION["nombre"] = $usuario->getNombreUsuario();
                $_SESSION["ID"] = $usuario->getID();

                // Configurar roles de usuario si es necesario
                if ($usuario->getRoles() == "empleado") {
                    $_SESSION["esEmpleado"] = true;
                }
                if ($usuario->getRoles() == "admin") {
                    $_SESSION["esEmpleado"] = true;
                    $_SESSION["esAdmin"] = true;
                }
            }
        }
    }
}
?>
