<?php

define("WEBSITE_TITLE", 'MY SHOP');

//nome da database

// TODO: tenho que alterar para a minha base de dados
define('DB_NAME', "pap_db");
define('DB_USER', "root");
define('DB_PASS', "");
define('DB_TYPE',"mysql");
define('DB_HOST',"localhost");


define('THEME', 'eshop/');

define('DEBUG', true);

if (DEBUG){
    
    ini_set('display_errors', 1);
}else{
    ini_set('display_errors', 0);
}