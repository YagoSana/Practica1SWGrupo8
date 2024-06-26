<?php

require_once __DIR__ . '/Formulario.php';
require_once 'config.php';
require_once __DIR__ . '/src/usuarios/usuario.php';

class FormularioUploadProducto extends Formulario
{
    public function __construct()
    {
        parent::__construct('formUpload', ['urlRedireccion' => RUTA_APP . '/includes/vistas/plantillas/paginaConfirmacion.php' , 'enctype' => 'multipart/form-data']);
    }

    protected function generaCamposFormulario(&$datos)
    {
        $producto_nombre = $datos['producto_nombre'] ?? '';
        $producto_descripcion = $datos['producto_descripcion'] ?? '';
        $producto_precio = $datos['producto_precio'] ?? '';
        $producto_imagen = $datos['producto_imagen'] ?? '';
        $producto_tipo = $datos['producto_tipo'] ?? '';

        $erroresCampos = self::generaErroresCampos(['producto_nombre', 'producto_descripcion', 'producto_precio', 'producto_imagen', 'producto_tipo'], $this->errores, 'span', array('class' => 'error'));
        $rutajsjquery = RUTA_APP . '/includes/src/javaScript/jquery-3.7.1.min.js';
        $rutajsreg = RUTA_APP . '/includes/src/javaScript/upload.js';
        $contenido = <<<EOS
        <fieldset class='claseFormulario'>
            <div>
                <label for="producto_nombre">Nombre del Producto :</label>
                <input type="text" id="producto_nombre" name="producto_nombre" required>
                <span id="nombreOK">&#x2705;</span>
                <span id="nombreMal">&#x26A0;</span>
                {$erroresCampos['producto_nombre']}
                </div>
            <div>
                <label for="producto_descripcion">Descripcion del Producto :</label>
            </div>
            <div>
                <textarea id="producto_descripcion" name="producto_descripcion" rows="4" cols="43" required></textarea>
            </div>
            <div>
                <label for="producto_precio">Precio del Producto :</label>
                <input type="text" id="producto_precio" name="producto_precio" required>
                <span id="precioOK">&#x2705;</span>
                <span id="precioMal">&#x26A0;</span>
                {$erroresCampos['producto_precio']}
            </div>
            <div>
                <label for="producto_imagen">Imagen del Producto :</label>
                <input type="file" id="producto_imagen" name="producto_imagen" required>
                {$erroresCampos['producto_imagen']}
            </div>
            <div>
                <label for="producto_tipo">Tipo de Producto :</label>
                <select id="producto_tipo" name="producto_tipo" required>
                        <option value="Viento">Viento</option>
                        <option value="Percusion">Percusión</option>
                        <option value="Cuerda">Cuerda</option>
                        <option value="Articulos">Artículos</option>
                </select>
            </div>
            <div id='botonLogin'>
                <input type="submit" value="Subir Producto" id='botonEnviar'>
            </div>
            <script type="text/javascript" src=$rutajsjquery></script>
            <script type="text/javascript" src=$rutajsreg></script>
        </fieldset>
    EOS;

        return $contenido;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];
        $producto_nombre = trim($datos['producto_nombre'] ?? '');
        $producto_descripcion = trim($datos['producto_descripcion'] ?? '');
        $producto_precio = trim($datos['producto_precio'] ?? '');
        $producto_imagen = isset($_FILES['producto_imagen']);
        $producto_tipo = trim($datos['producto_tipo'] ?? '');

        if (empty($producto_nombre)) {
            $this->errores['producto_nombre'] = 'Por favor, introduce un nombre.';
        }

        if (empty($producto_descripcion)) {
            $this->errores['producto_descripcion'] = 'Por favor, introduce una descripción.';
        }

        if (empty($producto_precio)) {
            $this->errores['producto_precio'] = 'Por favor, introduce un precio.';
        }

        if (!$producto_imagen) {
            $this->errores['producto_imagen'] = 'Por favor, introduce una foto.';
        }

        if (empty($producto_tipo)) {
            $this->errores['producto_tipo'] = 'Por favor, elige un tipo.';
        }

        if (count($this->errores) === 0) {
            //gestion del producto     
            $ruta = $_FILES['producto_imagen']['tmp_name'];
            $target = "/img/imagenesBD/" . $_FILES['producto_imagen']['name'];
            
            if (move_uploaded_file($ruta, RAIZ_APP . $target)) {

                $Visible = 1;
                $Reacondicionado = 0;
                $Stock = 10;
                $producto = new Producto(null, $producto_nombre, $producto_descripcion, $producto_precio, $target, $Stock, $Visible, $producto_tipo, $Reacondicionado);
                $producto->createProducto($producto_nombre, $producto_descripcion, $producto_precio, $target, $Stock, $Visible, $producto_tipo, $Reacondicionado);
            } else {
                // Error al mover el archivo
                $this->errores['producto_imagen'] = 'Error al mover la imagen.';
            }
        }
    }
}