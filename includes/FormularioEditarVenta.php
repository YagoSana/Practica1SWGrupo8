<?php
require_once __DIR__ . '/Formulario.php';
require_once 'config.php';
require_once __DIR__ . '/src/usuarios/usuario.php';
require_once 'vistas/helpers/venta.php';

class FormularioEditarVenta extends Formulario {

    private $idVenta;
    private $idUsuario;

    public function __construct($idVenta, $idUsuario) {
        parent::__construct('formEditarVenta', ['urlRedireccion' => RUTA_APP . '/includes/vistas/plantillas/mostrarGestionVentas.php']);

        $this->idVenta = $idVenta;
        $this->idUsuario = $idUsuario;
    }

    protected function generaCamposFormulario(&$datos){

        $nombre = $datos['nombre'] ?? '';
        $descripcion = $datos['descripcion'] ?? '';
        $valor = $datos['valor'] ?? '';
        $categoria = $datos['categoria'] ?? '';

        $erroresCampos = self::generaErroresCampos(['nombre', 'descripcion', 'valor', 'categoria', 'imagen'], $this->errores, 'span', array('class' => 'error'));

        $contenido = <<<EOS
        <fieldset class='claseFormulario'>
            <div>
                <label for="nombre">Nombre del producto :</label>
                <input id="nombre" type="text" name="nombre" value="$nombre" required />
                {$erroresCampos['nombre']}
            </div>
            <div>
                <label for="descripcion">Descripción :</label>
                <textarea id="descripcion" name="descripcion" rows="4" cols="40" required>$descripcion</textarea>
                {$erroresCampos['descripcion']}
            </div>
            <div>
                <label for="valor">Valor :</label>
                <input id="valor" type="text" name="valor" value="$valor" required />
                {$erroresCampos['valor']}
            </div>
            <div>
                <label for="categoria">Categoría :</label>
                <select id="categoria" name="categoria" required>
                    <option value="cuerda" $categoria == 'cuerda' ? 'selected' : ''>Cuerda</option>
                    <option value="viento" $categoria == 'viento' ? 'selected' : ''>Viento</option>
                    <option value="percusion" $categoria == 'percusion' ? 'selected' : ''>Percusión</option>
                    <option value="articulo" $categoria == 'articulo' ? 'selected' : ''>Artículo</option>
                </select>
                {$erroresCampos['categoria']}
            </div>
            <div>
                <input type="submit" value="Añadir producto">
            </div>
        </fieldset>
        EOS;

        return $contenido;
    }

    protected function procesaFormulario(&$datos){

        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }
}