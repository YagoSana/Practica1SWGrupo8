<?php
/* */
/* Parámetros de configuración de la aplicación */
/* */
require_once 'aplicacion.php';
// Parámetros de configuración generales
define('RAIZ_APP',dirname(__DIR__)); //ruta absoluta a donde está index.php
define('RUTA_APP','/Practica3'); //cada uno pone aqui el nombre del directorio donde tiene la web en localhost
define('RUTA_IMGS',RUTA_APP.'/img');
define('RUTA_CSS',RUTA_APP.'/css');
define('RUTA_INCL',RUTA_APP.'/includes');
define('RUTA_SQL',RUTA_APP.'/mysql');
define('RUTA_SRC',RUTA_INCL.'/src');
define('RUTA_VISTAS',RUTA_INCL.'/vistas');
define('RUTA_USU',RUTA_SRC.'/usuarios');


// Parámetros de configuración de la BD
define('BD_HOST', 'vm005.db.swarm.test'); //vm005.db.swarm.test
define('BD_NAME', 'Practica3'); //Practica3
define('BD_USER', 'Practica3'); //Practica3
define('BD_PASS', 'Practica3'); //Practica3

$app = Aplicacion::getInstance();
$app->init(['host'=>BD_HOST, 'bd'=>BD_NAME, 'user'=>BD_USER, 'pass'=>BD_PASS]);
/* */
/* Configuración de Codificación y timezone */
/* */

ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');
date_default_timezone_set('Europe/Madrid');
/*
spl_autoload_register(function ($class) {
    
    // project-specific namespace prefix
    $prefix = 'es\\ucm\\fdi\\sw\\';
    
    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/';
    
    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }
    
    // get the relative class name
    $relative_class = substr($class, $len);
    
    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }//else{
       // die($file);
    //}
});

$app = es\ucm\fdi\sw\Aplicacion::getInstance();
$app->init(array('host'=>BD_HOST, 'bd'=>BD_NAME, 'user'=>BD_USER, 'pass'=>BD_PASS));

register_shutdown_function([$app, 'shutdown']);
*/

