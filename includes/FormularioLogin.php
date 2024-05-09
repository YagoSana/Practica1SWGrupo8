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
        
        $nombreUsuario = $datos['username'] ?? '';
        $password = $datos['password'] ?? '';

        
        $erroresCampos = self::generaErroresCampos(['username', 'password'], $this->errores, 'span', array('class' => 'error'));
        $linkRegistro = RUTA_APP . '/includes/src/register.php';


        
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

        
        if (empty($nombreUsuario)) {
            $this->errores['username'] = 'El nombre de usuario no puede estar vacío';
        }
        if (empty($password)) {
            $this->errores['password'] = 'El password no puede estar vacío.';
        }

        
        if (count($this->errores) === 0) {
            $usuario = Usuario::login($nombreUsuario, $password);

            if (!$usuario) {
                $this->errores[] = "El usuario o el password no coinciden";
            } else {
                session_start();
                $_SESSION["login"] = true;
                $_SESSION["nombre"] = $usuario->getNombreUsuario();
                $_SESSION["ID"] = $usuario->getID();

                //para usar en editar perfil
                $_SESSION["apellido"] = $usuario->getApellido();
                $_SESSION["email"] = $usuario->getEmail();
                $_SESSION["nombrePila"] = $usuario->getNombre();

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
