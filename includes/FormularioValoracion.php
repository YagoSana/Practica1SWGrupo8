<?php

//require_once '../../config.php';
//require_once '../../src/usuarios/usuario.php';
//require_once '../../includes/src/usuarios/valoracion.php';
require_once 'Formulario.php';

class FormularioValoracion extends Formulario
{
    private $pedidoId;
    private $productoId;

    public function __construct($pedidoId, $productoId)
    {
        parent::__construct('FormValoracion', ['urlRedireccion' => RUTA_APP . '/includes/vistas/plantillas/mostrarValoracion.php?id=' . $pedidoId, 'method'=>'POST', 'enctype'=>'multipart/form-data']);
        $this->pedidoId = $pedidoId;
        $this->productoId = $productoId;
    }

    protected function generaCamposFormulario(&$datos)
    {
        $pedido_id = $datos['pedido_id'] ?? '';
        $producto_id = $datos['producto_id'] ?? '';
        $valoracion = $datos['valoracion'] ?? '';
        $comentario = $datos['comentario'] ?? '';
        $rutajsval = RUTA_APP . '/includes/src/javaScript/valoraciones.js';
        $erroresCampos = self::generaErroresCampos(['pedido_id', 'producto_id', 'valoracion', 'comentario'], $this->errores, 'span', array('class' => 'error'));

        $htmlCamposFormulario = <<<EOS
        <div class='val'>
            <input type="hidden" id="pedido_id" name="pedido_id" value="$this->pedidoId">
            <input type="hidden" id="producto_id" name="producto_id" value="$this->productoId ?>">
            <required>
            <label class="opcion">
                <input type="radio" id="valoracion" name="valoracion" value="1"> 1
            </label>
            <label class="opcion">
                <input type="radio" id="valoracion" name="valoracion" value="2"> 2
            </label>
            <label class="opcion">
                <input type="radio" id="valoracion" name="valoracion" value="3"> 3
            </label>
            <label class="opcion">
                <input type="radio" id="valoracion" name="valoracion" value="4"> 4
            </label>
            <label class="opcion">
                <input type="radio" id="valoracion" name="valoracion" value="5"> 5
            </label>
            </required>
            <textarea id="comentario" name="comentario" minlength="50" maxlength="1500" required></textarea>
            <input type="submit" value="Enviar valoración">
        </div>
        <script type="text/javascript" src=$rutajsval></script>
        EOS;

        return $htmlCamposFormulario;
    }

    protected function procesaFormulario(&$datos)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $pedidoId = $datos['pedido_id'];
        $productoId = $datos['producto_id'];
        $valoracion = $datos['valoracion'] ?? null;
        $comentario = $datos['comentario'];

        if ($valoracion !== null) {
            Usuario::valorarProducto($productoId, $pedidoId, $_SESSION['usuario']->getId(), $valoracion, $comentario);
        } else {
            $this->errores[] = "La valoración no puede ser nula";
        }
       // Usuario::valorarProducto($productoId, $pedidoId, $_SESSION['usuario']->getId(), $valoracion, $comentario);
    }
}

?>
