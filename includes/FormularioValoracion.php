<?php

require_once 'Formulario.php';
require_once 'config.php';
require_once __DIR__.'/src/usuarios/usuario.php';
session_start();

class FormularioValoracion extends Formulario {
    public function __construct() {
        parent::__construct('formValoracion', ['urlRedireccion' => RUTA_APP . 'index.php']);
    }
    
    protected function generaCamposFormulario(&$datos) {
        $pedido_id = $datos['pedido_id'] ?? '';
        $valoracion = $datos['valoracion'] ?? '';
        $comentario = $datos['comentario'] ?? '';
        
        $erroresCampos = self::generaErroresCampos(['pedido_id', 'valoracion', 'comentario'], $this->errores, 'span', array('class' => 'error'));
        // Generar los campos HTML del formulario
        $contenido = <<<EOS
            <fieldset>
                <legend>Valore nuestro producto :D</legend>
                <input type="hidden" name="pedido_id" value="$pedido_id">
                <label>
                    <input type="radio" name="valoracion" value="1"> 1
                </label>
                <label>
                    <input type="radio" name="valoracion" value="2"> 2
                </label>
                <label>
                    <input type="radio" name="valoracion" value="3"> 3
                </label>
                <label>
                    <input type="radio" name="valoracion" value="4"> 4
                </label>
                <label>
                    <input type="radio" name="valoracion" value="5"> 5
                </label>
                <textarea name="comentario" minlength="50" maxlength="1500" required></textarea>
                <input type="submit" value="Enviar valoración">
            </fieldset>
        EOS;
    
        return $contenido;
    }
    

    protected function procesaFormulario(&$datos) {
        
        $this->errores = [];
        $pedido_id = trim($datos['pedido_id'] ?? '');
        $valoracion = trim($datos['valoracion'] ?? '');
        $comentario = trim($datos['comentario'] ?? '');
    
        if (empty($pedido_id) || empty($valoracion) || empty($comentario)) {
            $this->errores[] = "Por favor, complete todos los campos.";
            
        }
    
        if (!is_numeric($valoracion) || $valoracion < 1 || $valoracion > 5) {
            $this->errores[] = "La valoración debe ser un número entre 1 y 5.";
            
        }
    
        if (strlen($comentario) < 50 || strlen($comentario) > 1500) {
            $this->errores[] = "La longitud del comentario debe estar entre 50 y 1500 caracteres.";
            
        }
    
        Usuario::valorarProducto($pedido_id, $_SESSION['usuario']->getId(), $valoracion, $comentario);
    
    
    }
    
    
}
?>
