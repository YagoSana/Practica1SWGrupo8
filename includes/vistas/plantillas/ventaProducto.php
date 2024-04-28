<?php
require '../../config.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
        <?php include RAIZ_APP . '/includes/vistas/comun/header.php'; ?>
        <title>Subir Producto</title>
</head>

<body>
        <div id="contenedor">
                <?php include RAIZ_APP . '/includes/vistas/comun/cabecera.php'; ?>
                <?php include RAIZ_APP . '/includes/vistas/comun/lateralIzq.php'; ?>
                <main>
                        <form action="<?= RUTA_APP . '/includes/vistas/helpers/procesarVentaCliente.php'?>" method="POST" enctype="multipart/form-data">
                                <p>
                                        <label for="venta_nombre">Nombre del Producto:</label>
                                        <input type="text" id="venta_nombre" name="venta_nombre" required>
                                </p>
                                <p>
                                        <label for="venta_descripcion">Descripcion del Producto:</label>
                                </p>
                                <p>
                                        <textarea id="venta_descripcion" name="venta_descripcion" rows="4"
                                                cols="50" required></textarea>
                                </p>
                                <p>
                                        <label for="venta_imagen">Imagen del Producto:</label>
                                        <input type="file" id="venta_imagen" name="venta_imagen" required>
                                </p>
                                <input type="submit" value="Subir Producto">
                        </form>

                </main>
                <?php include RAIZ_APP . '/includes/vistas/comun/pieDePagina.php'; ?>
        </div>
</body>

</html>
