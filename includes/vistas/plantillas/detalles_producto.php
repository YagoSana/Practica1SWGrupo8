<?php
// Incluye el archivo de la clase Database
include ("../helpers/baseDatos.php");
require ("../../config.php");
require_once ("../helpers/producto.php");

// Crea una nueva instancia de la clase Database
$db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);

// Conecta a la base de datos
$db->connect();

// Obtiene el ID del producto de la URL
$producto_id = $_GET['id'];

// Realiza la consulta para obtener los detalles del producto
$sql = "SELECT * FROM productos WHERE ID = $producto_id";
$result = $db->getConnection()->query($sql);

if ($result === false) {
    die('Error en la consulta SQL: ' . $db->getConnection()->$error);
}

// Obtiene los detalles del producto
$producto = $result->fetch();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include RAIZ_APP . '/includes/vistas/comun/header.php'; ?>
    <title>Detalles del producto</title>
</head>

<body>
    <div id="contenedor">
        <?php include RAIZ_APP . '/includes/vistas/comun/cabecera.php'; ?>
        <?php include RAIZ_APP . '/includes/vistas/comun/lateralIzq.php'; ?>
        <main>
            <article>
                <section>
                    <h2>Detalles del producto</h2>
                    <div class='producto'>
                        <img src='<?php echo RUTA_APP . $producto['Imagen']; ?>' alt='Imagen del producto'>
                        <div>
                            <h3><?php echo $producto['Nombre']; ?></h3>
                            <p><?php echo $producto['Descripcion']; ?></p>
                            <p><?php echo $producto['Precio']; ?></p>
                        </div>
                    </div>
                </section>
            </article>
        </main>
    </div>
</body>

</html>
