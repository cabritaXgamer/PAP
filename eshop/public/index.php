<?php

session_start();

$path = $_SERVER['REQUEST_SCHEME'] . "://". $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
$path = str_replace("index.php", "", $path);

//Define constant to ROOT folder
define('ROOT', $path);

//Define constant to ASSETS folder
define ('ASSETS', $path . "assets/");

//Define constant to TEMPLATE folder
define('THEME', 'eshop/');

include "../app/init.php";
//show($_SERVER);

$app = new App();

