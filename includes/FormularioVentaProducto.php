<?php
require_once __DIR__ . '/Formulario.php';
require_once 'config.php';
require_once __DIR__ . '/src/usuarios/usuario.php';
require_once 'vistas/helpers/venta.php';

class FormularioVentaProducto extends Formulario
{
    public function __construct()
    {
        parent::__construct('formVenta', ['urlRedireccion' => RUTA_APP . '/includes/vistas/plantillas/paginaConfirmacion.php','enctype' => 'multipart/form-data']);
    }

    protected function generaCamposFormulario(&$datos)
    {
        $venta_nombre = $datos['venta_nombre'] ?? '';
        $venta_precio = $datos['venta_precio'] ?? '';
        $venta_categoria = $datos['venta_categoria'] ?? '';
        $venta_descripcion = $datos['venta_descripcion'] ?? '';
        $venta_imagen = $datos['venta_imagen'] ?? '';

        $erroresCampos = self::generaErroresCampos(['venta_nombre', 'venta_precio', 'venta_categoria', 'venta_descripcion', 'venta_imagen'], $this->errores, 'span', array('class' => 'error'));
        $rutajsjquery = RUTA_APP . '/includes/src/javaScript/jquery-3.7.1.min.js';
        $rutajsreg = RUTA_APP . '/includes/src/javaScript/venta.js';
        $htmlCamposFormulario = <<<EOS
        <fieldset class='claseFormulario'>
            <div>
                <label for="venta_nombre">Nombre :</label>
                <input type="text" id="venta_nombre" name="venta_nombre" required>
                <span id="nombreOK">&#x2705;</span>
                <span id="nombreMal">&#x26A0;</span>
            </div>
            <div>
                <label for="venta_precio">Precio :</label>
                <input type="text" id="venta_precio" name="venta_precio" required>
                <span id="precioOK">&#x2705;</span>
                <span id="precioMal">&#x26A0;</span>
            </div>
            <div>
                <label for="venta_categoria">Categoría :</label>
                <select name="venta_categoria">';
                    <option value="cuerda">Cuerda</option>
                    <option value="viento">Viento</option>
                    <option value="percusion">Percusión</option>'
                    <option value="articulo">Artículo</option>
                </select>
            </div>
            <div>
                <label for="venta_descripcion">Descripcion :</label>
            </div>
            <div>
                <textarea id="venta_descripcion" name="venta_descripcion" rows="4" cols="50" required></textarea>
            </div>
            
            <div>
                <label for="venta_imagen">Imagen del Producto:</label>
                <input type="file" id="venta_imagen" name="venta_imagen" required>
            </div>
            <div id='botonLogin'>
                <input type="submit" value="Subir Producto">
            </div>
            <script type="text/javascript" src=$rutajsjquery></script>
            <script type="text/javascript" src=$rutajsreg></script>
        </fieldset>
        EOS;

        return $htmlCamposFormulario;
    }

    protected function procesaFormulario(&$datos)
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->errores = [];

        $venta_nombre = trim($datos['venta_nombre'] ?? '');
        $venta_precio = trim($datos['venta_precio'] ?? '');
        $venta_categoria = trim($datos['venta_categoria'] ?? '');
        $venta_descripcion = trim($datos['venta_descripcion'] ?? '');
        $venta_imagen = isset($_FILES['venta_imagen']);

        // Validación de campos
        if (empty($venta_nombre)) {
            $this->errores['venta_nombre'] = 'El nombre no puede estar vacío';
        }
        if (empty($venta_precio)) {
            $this->errores['venta_precio'] = 'El precio no puede estar vacío';
        }
        if (empty($venta_categoria)) {
            $this->errores['venta_categoria'] = 'La categoría no puede estar vacía';
        }
        if (empty($venta_descripcion)) {
            $this->errores['venta_descripcion'] = 'La descripción no puede estar vacía.';
        }
        if (!$venta_imagen) {
            $this->errores['venta_imagen'] = 'Por favor, introduce una foto.';
        }

        // Procesamiento de formulario
        if (count($this->errores) === 0) {

            $ruta = $_FILES['venta_imagen']['tmp_name'];
            $target = "/img/imagenesBD/" . $_FILES['venta_imagen']['name'];

            if (move_uploaded_file($ruta, RAIZ_APP . $target)) {

                $ID_Usuario = $_SESSION['usuario']->getId();

                $Estado = "Pendiente";

                $venta = new Venta(null, $ID_Usuario, $venta_nombre, $venta_descripcion, $_FILES['venta_imagen']['name'], $venta_precio, $venta_categoria, $Estado);

                $venta->createVenta();

                header('Location: ' . RUTA_APP . '/includes/vistas/plantillas/paginaConfirmacion.php');
            } else {
                $this->errores['venta_imagen'] = 'Error al subir la imagen';
            }
        }
    }
}
