<?php
// Incluye el archivo de la clase Database, Usuario y Producto
//include ("../helpers/Database.php");
use es\ucm\fdi\sw\vistas\helpers\Database;
require ("../../config.php");
//require_once ("../helpers/Producto.php");
use es\ucm\fdi\sw\vistas\helpers\Producto;
//require_once RAIZ_APP. '/includes/src/Usuarios/Usuario.php';
use es\ucm\fdi\sw\usuarios\Usuario;


// Crea una nueva instancia de la clase Database
$db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);

// Conecta a la base de datos
$db->connect();

// Obtiene el ID del Producto de la URL
$Producto_id = $_GET['id'];

// Usa el método getProducto de la clase Producto para obtener los detalles del Producto
$Producto = Producto::getProducto($Producto_id, $db->getConnection());

// Usa el método getValoracion para obtener las Valoraciones del Producto
$Valoraciones = Valoracion::getValoracion($Producto_id, $db->getConnection());
$ruta = RUTA_APP;

ob_start();
?>
<article>
    <section>
        <h2>Detalles del Producto</h2>
        <div class='detalle_Producto'>
            <img src='<?php echo $ruta . $Producto->getImagen(); ?>' alt='Imagen del Producto'>
            <div>
                <h3><?php echo $Producto->getNombre(); ?></h3>
                <p><?php echo $Producto->getDescripcion(); ?></p>
                <h4>Valoraciones</h4>
                <?php foreach ($Valoraciones as $Valoracion) { 
                    $Usuario = Usuario::buscaPorId($Valoracion["IdUsuario"]);
                ?>
                    <div class='Valoracion'>
                        <p>Usuario: <?php echo $Usuario->getNombre(); ?></p>
                        <p>Valoración: <?php echo $Valoracion['Valoracion']; ?></p>
                        <p>Comentario: <?php echo $Valoracion['Comentario']; ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</article>
<?php
$contenido = ob_get_clean();
require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
?>
