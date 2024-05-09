<?php
require_once __DIR__ . '/Formulario.php';
require_once 'config.php';
require_once __DIR__ . '/src/usuarios/usuario.php';
require_once 'vistas/helpers/venta.php';

class FormularioEditarVenta extends Formulario
{

    private $idVenta;
    private $idUsuario;
    private $ventaReal;

    public function __construct($idVenta, $idUsuario)
    {
        parent::__construct('formEditarVenta', ['urlRedireccion' => RUTA_APP . '/includes/vistas/plantillas/mostrarGestionVentas.php']);

        $this->idVenta = $idVenta;
        $this->idUsuario = $idUsuario;
        $this->ventaReal = Venta::getVentaById($this->idVenta);
    }

    protected function generaCamposFormulario(&$datos)
    {
        $venta = Venta::getVentaById($this->idVenta);
        $nombre = $venta->getNombre();
        $valor = $venta->getPrecio();
        $descripcion = $venta->getDescripcion();
        $categoria = $venta->getCategoria();
        $imagen = $venta->getimagen();
        $rutaimagen = RUTA_IMGS . "/imagenesBD/" . $imagen;
        $erroresCampos = self::generaErroresCampos(['venta_nombre', 'venta_descripcion', 'venta_precio', 'venta_categoria'], $this->errores, 'span', array('class' => 'error'));
        $rutajsjquery = RUTA_APP . '/includes/src/javaScript/jquery-3.7.1.min.js';
        $rutajsreg = RUTA_APP . '/includes/src/javaScript/venta.js';
        $contenido = <<<EOS
        <fieldset class='claseFormulario'>
            <div>
                <label for="venta_nombre">Nombre del producto :</label>
                <input id="venta_nombre" type="text" name="venta_nombre" value="$nombre" required />
                <span id="nombreOK">&#x2705;</span>
                <span id="nombreMal">&#x26A0;</span>
                {$erroresCampos['venta_nombre']}
            </div>
            <div>
                <label for="venta_descripcion">Descripción :</label>
                <textarea id="venta_descripcion" name="venta_descripcion" rows="4" cols="40" required>$descripcion</textarea>
                {$erroresCampos['venta_descripcion']}
            </div>
            <div>
                <label for="venta_precio">Valor :</label>
                <input id="venta_precio" type="text" name="venta_precio" value="$valor" required />
                <span id="precioOK">&#x2705;</span>
                <span id="precioMal">&#x26A0;</span>
                {$erroresCampos['venta_precio']}
            </div>
            <div>
                <label for="venta_categoria">Categoría :</label>
                <select id="venta_categoria" name="venta_categoria" required>
                    <option value="cuerda" $categoria == 'cuerda' ? 'selected' : ''>Cuerda</option>
                    <option value="viento" $categoria == 'viento' ? 'selected' : ''>Viento</option>
                    <option value="percusion" $categoria == 'percusion' ? 'selected' : ''>Percusión</option>
                    <option value="articulo" $categoria == 'articulo' ? 'selected' : ''>Artículo</option>
                </select>
                {$erroresCampos['venta_categoria']}
            </div>
            <div>
                <label for="venta_imagen">Imagen :</label>
                <img src='$rutaimagen' alt="Imagen del producto">
            </div>
            <div id='botonLogin'>
                <input type="submit" value="Editar producto">
            </div>
            <script type="text/javascript" src=$rutajsjquery></script>
            <script type="text/javascript" src=$rutajsreg></script>
        </fieldset>
        EOS;

        return $contenido;
    }
    
    protected function procesaFormulario(&$datos)
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        //venta actualizada
        
        $this->errores = [];
        
        $nombre = trim($datos['venta_nombre'] ?? '');
        $valor = trim($datos['venta_precio'] ?? '');
        $categoria = trim($datos['venta_categoria'] ?? '');
        $descripcion = trim($datos['venta_descripcion'] ?? '');
        
        // Validación de campos
        if (empty($nombre)) {
            $this->errores['venta_nombre'] = 'El nombre no puede estar vacío';
        }
        if (empty($valor)) {
            $this->errores['venta_precio'] = 'El precio no puede estar vacío';
        }
        if (empty($categoria)) {
            $this->errores['venta_categoria'] = 'La categoría no puede estar vacía';
        }
        if (empty($descripcion)) {
            $this->errores['venta_descripcion'] = 'La descripción no puede estar vacía.';
        }
        
        // Procesamiento de formulario
        if (count($this->errores) === 0) {
            
            $ID_Usuario = $this->idVenta;
            
            $Estado = "Pendiente";
            
             Venta::editVenta($ID_Usuario, $nombre, $descripcion, $valor, $categoria, $Estado);

            header('Location: ' . RUTA_APP . '/includes/vistas/plantillas/paginaConfirmacion.php');
            
        }
    }
}
