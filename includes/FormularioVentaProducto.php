<?php
require_once __DIR__ . '/Formulario.php';
require_once 'config.php';
require_once __DIR__ . '/src/usuarios/usuario.php';
require_once 'vistas/helpers/venta.php';

class FormularioVentaProducto extends Formulario
{
    public function __construct()
    {
        parent::__construct('formLogin', ['urlRedireccion' => RUTA_APP . '/includes/vistas/plantillas/paginaConfirmacion.php'], ['enctype' => 'multipart/form-data']);
    }

    protected function generaCamposFormulario(&$datos)
    {
        $venta_nombre = $datos['venta_nombre'] ?? '';
        $venta_descripcion = $datos['venta_descripcion'] ?? '';
        $venta_imagen = $datos['venta_imagen'] ?? '';

        $erroresCampos = self::generaErroresCampos(['venta_nombre', 'venta_descripcion', 'venta_imagen'], $this->errores, 'span', array('class' => 'error'));

        $htmlCamposFormulario = <<<EOS
        <fieldset class='claseFormulario'>
            <div>
                        <label for="venta_nombre">Nombre del Producto:</label>
                        <input type="text" id="venta_nombre" name="venta_nombre" required>
            </div>
            <div>
                        <label for="venta_descripcion">Descripcion del Producto:</label>
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
        $venta_descripcion = trim($datos['venta_descripcion'] ?? '');
        $venta_imagen = trim($datos['venta_imagen'] ?? '');

        // Validación de campos
        if (empty($venta_nombre)) {
            $this->errores['venta_nombre'] = 'El nombre no puede estar vacío';
        }
        if (empty($venta_descripcion)) {
            $this->errores['venta_descripcion'] = 'La descripción no puede estar vacía.';
        }
        if (empty($venta_imagen)) {
            $this->errores['venta_imagen'] = 'Por favor, introduce una foto.';
        }

        // Procesamiento de formulario
        if (count($this->errores) === 0) {

            $ruta = $_FILES['venta_imagen']['tmp_name'];

            $target = "/img/imagenesBD/" . $venta_imagen;

            if (move_uploaded_file($ruta, RAIZ_APP . $target)) {

                $ID_Usuario = $_SESSION['usuario']->getId();

                $Estado = "Pendiente";

                $venta = new Venta(null, $ID_Usuario, $venta_nombre, $venta_descripcion, $venta_imagen, $Estado);

                $venta->createVenta();

                header('Location: ' . RUTA_APP . '/includes/vistas/plantillas/paginaConfirmacion.php');
            } else {
                $this->errores['venta_imagen'] = 'Error al subir la imagen';
            }
        }
    }
}
