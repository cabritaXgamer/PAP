<?php

define("WEBSITE_TITLE", 'MY SHOP');

//nome da database

// TODO: tenho que alterar para a minha base de dados
define('DM_NAME', "eshop_db");
define('DM_USER', "root");
define('DM_PASS', "");
define('THEME','eshop');

define('DEBUG', true);

if (DEBUG){
    
    ini_set('display_errors', 1);
}else{
        ini_set('display_errors', 0);
}