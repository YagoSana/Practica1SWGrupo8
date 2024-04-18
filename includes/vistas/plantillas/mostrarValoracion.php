<?php
require '../../config.php';
require_once RAIZ_APP. '/includes/src/usuarios/usuario.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include RAIZ_APP . '/includes/vistas/comun/header.php'; ?>
    <title>Sistema de Valoracion BACK MUSIC</title>
</head>

<body>
    <div id="contenedor">
        <?php include RAIZ_APP . '/includes/vistas/comun/cabecera.php'; ?>
        <?php include RAIZ_APP . '/includes/vistas/comun/lateralIzq.php'; ?>
        <main>
            <h2>Valore nuestro producto :D</h2>
            
            <form action="<?php echo RUTA_APP; ?>/includes/vistas/helpers/procesarValoracion.php" method="POST">
                <input type="hidden" name="pedido_id" value="<?php echo $_GET['id']; ?>">
                <label>
                    <input type="radio" name="valoracion" value="1"> 1
                </label>
                <label>
                    <input type="radio" name="valoracion" value="2"> 2
                </label>
                <label>
                    <input type="radio" name="valoracion" value="3"> 3
                </label>
                <label>
                    <input type="radio" name="valoracion" value="4"> 4
                </label>
                <label>
                    <input type="radio" name="valoracion" value="5"> 5
                </label>
                <textarea name="comentario" minlength="50" maxlength="1500" required></textarea>
                <input type="submit" value="Enviar valoración">
            </form>
        </main>
        <?php include RAIZ_APP . '/includes/vistas/comun/pieDePagina.php'; ?>
    </div>
</body>

</html>