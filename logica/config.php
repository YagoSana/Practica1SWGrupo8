<?php
/* */
/* Parámetros de configuración de la aplicación */
/* */

// Parámetros de configuración generales
define('RUTA_APP', '/Practica2'); //cada uno pone aqui el nombre del directorio donde tiene la web en localhost
define('RUTA_IMGS', RUTA_APP.'/img');
define('RUTA_CSS', RUTA_APP.'/estilos');

// Parámetros de configuración de la BD
define('BD_HOST', 'localhost');
define('BD_NAME', 'bd_def');
define('BD_USER', 'root');
define('BD_PASS', '');


/* */
/* Configuración de Codificación y timezone */
/* */

ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');
date_default_timezone_set('Europe/Madrid');

//no es necesario cerrar los php