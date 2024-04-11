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
            <h2>Indique el Producto a eliminar</h2>
            <form action="<?= RUTA_APP . '/includes/vistas/helpers/procesarEliminacion.php' ?>" method="POST">
                <p>
                    <label for="Producto_id">Identificador:</label>
                    <input type="text" id="Producto_id" name="Producto_id" required>
                </p>
                <input type="submit" value="Eliminar Producto">
            </form>

        </main>
        <?php include RAIZ_APP . '/includes/vistas/comun/pieDePagina.php'; ?>
    </div>
</body>

</html>