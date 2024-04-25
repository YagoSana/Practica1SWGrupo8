<?php
require_once '../../config.php';
require 'producto.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario
    $Nombre = $_POST['producto_nombre'];
    $Descripcion = $_POST['producto_descripcion'];
    $Precio = $_POST['producto_precio'];
    $Stock = $_POST['producto_stock'];
    $Tipo = $_POST['producto_tipo'];

    // Valida que el nombre tenga al menos 5 caracteres
    if (strlen($Nombre) < 5) {
        $ruta = RUTA_APP; 
        $contenido = <<<EOS
        <h2> El nombre debe tener al menos 5 caracteres </h2>
            <form action="$ruta/includes/vistas/helpers/procesarProducto.php" method="POST" enctype="multipart/form-data">
                    <p>
                            <label for="producto_nombre">Nombre del Producto:</label>
                            <input type="text" id="producto_nombre" name="producto_nombre" required>
                    </p>
                    <p>
                            <label for="producto_descripcion">Descripcion del Producto:</label>
                    </p>
                    <p>
                            <textarea id="producto_descripcion" name="producto_descripcion" rows="4" cols="50" required></textarea>
                    </p>
                    <p>
                            <label for="producto_precio">Precio del Producto:</label>
                            <input type="text" id="producto_precio" name="producto_precio" required>
                    </p>
                    <p>
                            <label for="producto_imagen">Imagen del Producto:</label>
                            <input type="file" id="producto_imagen" name="producto_imagen" required>
                    </p>
                    <input type="submit" value="Subir Producto">
            </form>
        EOS;
        require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
    }

    // Valida que el precio sea un número
    else if (!is_numeric($Precio)) {
        $ruta = RUTA_APP; 
        $contenido = <<<EOS
        <h2> El precio debe ser un número </h2>
            <form action="$ruta/includes/vistas/helpers/procesarProducto.php" method="POST" enctype="multipart/form-data">
                    <p>
                            <label for="producto_nombre">Nombre del Producto:</label>
                            <input type="text" id="producto_nombre" name="producto_nombre" required>
                    </p>
                    <p>
                            <label for="producto_descripcion">Descripcion del Producto:</label>
                    </p>
                    <p>
                            <textarea id="producto_descripcion" name="producto_descripcion" rows="4" cols="50" required></textarea>
                    </p>
                    <p>
                            <label for="producto_precio">Precio del Producto:</label>
                            <input type="text" id="producto_precio" name="producto_precio" required>
                    </p>
                    <p>
                            <label for="producto_imagen">Imagen del Producto:</label>
                            <input type="file" id="producto_imagen" name="producto_imagen" required>
                    </p>
                    <input type="submit" value="Subir Producto">
            </form>
        EOS;    
        require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
    }
    else{
    $Imagen = $_FILES['producto_imagen']['name'];
    $ruta = $_FILES['producto_imagen']['tmp_name'];

    $target = "/img/imagenesBD/" . $Imagen;

    move_uploaded_file($ruta,RAIZ_APP."$target");

    $producto = new Producto(null, $Nombre, $Descripcion, $Precio, $target, $Stock, $Tipo);

    $producto->createProducto($Nombre, $Descripcion, $Precio, $target, $Stock,$Tipo);
    header('Location: ' . RUTA_APP . '/includes/vistas/plantillas/paginaConfirmacion.php');
    }
}

