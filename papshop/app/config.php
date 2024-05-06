<?php

define("WEBSITE_TITLE", 'MY PAGE');

//Database config
define('DB_NAME', "lmgdb");
define('DB_USER', "root");
define('DB_PASS', "");
define('DB_TYPE', "mysql");
define('DB_HOST', "localhost");


define('THEME', 'carserv');


//define('INCLUDES_THEME', "_includes/")


// Caminho para a raiz
define( 'ABSPATH', dirname( __FILE__ ) );


define('DEBUG', true);

if(DEBUG){
    ini_set('display_errors', 1);
}else{
    ini_set('display_errors', 0);
}