<?php
define('DATABASE_NAME', 'ADERUSSO_cs148_Final_JAM');

define('DEBUG', false);

$_SERVER = filter_input_array(INPUT_SERVER, FILTER_SANITIZE_STRING);
define('SERVER', $_SERVER['SERVER_NAME']);

define('DOMAIN', '//' . SERVER);

define('PHP_SELF', $_SERVER['PHP_SELF']);
define('PATH_PARTS', pathinfo(PHP_SELF));

define('BASE_PATH', DOMAIN . PATH_PARTS['dirname'] . '/');

define('LIB_PATH', 'lib/');

if(DEBUG){
    print '<p>';
    print 'DOMAIN: ' . DOMAIN . ' PHP_SELF: ' . PHP_SELF . ' PATH_PARTS: ' . PATH_PARTS . ' BASE_PATH: ' . BASE_PATH . ' LIB_PATH: ' . LIB_PATH; 
    print '</p>';
}
?>