<?php

define("WEBSITE_TITLE", 'MY PAGE');

//Database config
define('DB_NAME', "pap_db");
define('DB_USER', "root");
define('DB_PASS', "");
define('DB_TYPE', "mysql");
define('DB_HOST', "localhost");


define('ADMIN_THEME', 'admin/');
//define('INCLUDES_THEME', "_includes/")

define('DEBUG', true);

if(DEBUG){
    ini_set('display_errors', 1);
}else{
    ini_set('display_errors', 0);
}