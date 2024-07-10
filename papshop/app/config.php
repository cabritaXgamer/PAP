<?php

define("WEBSITE_TITLE", 'MY PAGE');

//Database config
// define('DB_NAME', "carshop");
define('DB_NAME', "carshop");
define('DB_USER', "root");
define('DB_PASS', "");
define('DB_TYPE', "mysql");
define('DB_HOST', "localhost");

define('THEME', 'carserv');

define('ADMIN_THEME', 'admin');
// Caminho para a raiz
define('ABSPATH', dirname(__FILE__));


define('DEBUG', true);

if (DEBUG) {
    ini_set('display_errors', 1);
} else {
    ini_set('display_errors', 0);
}
