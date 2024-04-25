<?php

require_once '../plantillas/mostrarVentas.php';
require_once '../../config.php';
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';
require_once RAIZ_APP. '/includes/vistas/helpers/venta.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the data from the form
    $Nombre = $_POST['venta_nombre']; 
    $Descripcion = $_POST['venta_descripcion']; 
   // $Imagen = $_POST['imagen']; 

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
    else{
        //Procesar el producto
        $Imagen = $_FILES['venta_imagen']['name'];
        $ruta = $_FILES['venta_imagen']['tmp_name'];

        $target = "/img/imagenesBD/" . $Imagen;

        move_uploaded_file($ruta, RAIZ_APP."$target");

        $ID_Usuario = $_SESSION['usuario']->getId();

        $Estado = "Pendiente";

        $venta = new Venta(null, $ID_Usuario, $Nombre, $Descripcion, $Imagen, $Estado);

        $venta->createVenta();

        header('Location: ' . RUTA_APP . '/includes/vistas/plantillas/paginaConfirmacion.php');
    }
    
}
