
<?php
require '../../config.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
        <?php include RAIZ_APP . '/includes/vistas/comun/header.php'; ?>
        <title>Login Back Music</title>
</head>

<body>
        <div id="contenedor">
                <?php include RAIZ_APP . '/includes/vistas/comun/cabecera.php'; ?>
                <?php include RAIZ_APP . '/includes/vistas/comun/lateralIzq.php'; ?>
                <main>
                        <form action="<?= RUTA_APP . '/includes/vistas/helpers/procesarProducto.php'?>"
                                method="POST" enctype="multipart/form-data">
                                <p>
                                        <label for="Producto_nombre">Nombre del Producto:</label>
                                        <input type="text" id="Producto_nombre" name="Producto_nombre" required>
                                </p>
                                <p>
                                        <label for="Producto_descripcion">Descripcion del Producto:</label>
                                </p>
                                <p>
                                        <textarea id="Producto_descripcion" name="Producto_descripcion" rows="4"
                                                cols="50" required></textarea>
                                </p>
                                <p>
                                        <label for="Producto_precio">Precio del Producto:</label>
                                        <input type="text" id="Producto_precio" name="Producto_precio" required>
                                </p>
                                <p>
                                        <label for="Producto_imagen">Imagen del Producto:</label>
                                        <input type="file" id="Producto_imagen" name="Producto_imagen" required>
                                </p>
                                <input type="submit" value="Subir Producto">
                        </form>

                </main>
                <?php include RAIZ_APP . '/includes/vistas/comun/pieDePagina.php'; ?>
        </div>
</body>

</html>