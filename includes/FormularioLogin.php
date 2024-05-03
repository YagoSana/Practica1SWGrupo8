<?php
require_once __DIR__.'/Formulario.php';
session_start();
require_once 'config.php';

require_once __DIR__.'/src/usuarios/usuario.php';

class FormularioLogin extends Formulario
{
    public function __construct() {
        parent::__construct('formLogin', ['urlRedireccion' => 'index.php']);
    }
    
    protected function generaCamposFormulario(&$datos)
    {
        // Se reutiliza el nombre de usuario introducido previamente o se deja en blanco
        $nombreUsuario = $datos['nombreUsuario'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombreUsuario', 'password'], $this->errores, 'span', array('class' => 'error'));

        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <legend>Usuario y contraseña</legend>
            <div>
                <label for="nombreUsuario">Nombre de usuario:</label>
                <input id="nombreUsuario" type="text" name="nombreUsuario" value="$nombreUsuario" />
                {$erroresCampos['nombreUsuario']}
            </div>
            <div>
                <label for="password">Password:</label>
                <input id="password" type="password" name="password" />
                {$erroresCampos['password']}
            </div>
            <div>
                <button type="submit" name="login">Entrar</button>
            </div>
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];
        $nombreUsuario = trim($datos['User'] ?? '');
        $nombreUsuario = filter_var($nombreUsuario, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $nombreUsuario || empty($nombreUsuario) ) {
            $this->errores['User'] = 'El nombre de usuario no puede estar vacío';
        }
        
        $password = trim($datos['Pass'] ?? '');
        $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $password || empty($password) ) {
            $this->errores['Pass'] = 'El password no puede estar vacío.';
        }

        if (count($this->errores) === 0) {
            $usuario = Usuario::login($nombreUsuario, $password);
        
            if (!$usuario) {
                $this->errores[] = "El usuario o el password no coinciden";
            } else {
                $_SESSION["login"] = true;
                $_SESSION["nombre"] = $User;
                $_SESSION["ID"] = $usuario->getID();
                
                if ($usuario->getRoles() == "empleado") {
                    $_SESSION["esEmpleado"] = true;
                }
                if ($usuario->getRoles() == "admin") {
                    $_SESSION["esEmpleado"] = true;
                    $_SESSION["esAdmin"] = true;
                }
            }
        }

        /////////////
        if (isset($_SESSION["login"])) {
            header('Location: ' . RUTA_APP . '/index.php');
        } else {
            $ruta = RUTA_SRC;   
            $contenido = <<<EOS
            <h2> Error en el inicio de sesión </h2>
            <h2>Inicio de sesión en BackMusic</h2>

                    <form action="$ruta/usuarios/procesarLogin.php" method="POST">
                        <p>
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username" required>
                        </p>
                        <p>
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" required>
                        </p>
                        <input type="submit" value="Login">
                    </form>

                    <h3>¿No tienes cuenta en nuestra web?</h3>
                    <p>Regístrate como un nuevo Usuario <a href="../register.php">aquí</a></p>
            EOS;
            require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
        }
    }
}
?>
