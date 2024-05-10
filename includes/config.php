<?php
/* */
/* Parámetros de configuración de la aplicación */
/* */
require_once 'aplicacion.php';
// Parámetros de configuración generales
define('RAIZ_APP',dirname(__DIR__)); //ruta absoluta a donde está index.php
define('RUTA_APP',''); //cada uno pone aqui el nombre del directorio donde tiene la web en localhost
define('RUTA_IMGS',RUTA_APP.'/img');
define('RUTA_CSS',RUTA_APP.'/css');
define('RUTA_INCL',RUTA_APP.'/includes');
define('RUTA_SQL',RUTA_APP.'/mysql');
define('RUTA_SRC',RUTA_INCL.'/src');
define('RUTA_VISTAS',RUTA_INCL.'/vistas');
define('RUTA_USU',RUTA_SRC.'/usuarios');


// Parámetros de configuración de la BD
define('BD_HOST', 'vm005.db.swarm.test'); //vm005.db.swarm.test //127.0.0.1
define('BD_NAME', 'bd_final'); //bd_final 
define('BD_USER', 'usuario_final');
define('BD_PASS', 'password_final');

$app = Aplicacion::getInstance();
$app->init(['host'=>BD_HOST, 'bd'=>BD_NAME, 'user'=>BD_USER, 'pass'=>BD_PASS]);
/* */
/* Configuración de Codificación y timezone */
/* */

ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');
date_default_timezone_set('Europe/Madrid');