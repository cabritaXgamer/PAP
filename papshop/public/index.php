<?php

session_start();

//Dynamic way to get ROOT folder
$path = $_SERVER['REQUEST_SCHEME'] . "://". $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
$path = str_replace("index.php", "", $path);

//Definiton to ROOT project
define('ROOT', $path);
//Definition to assets folder
define('ASSETS', $path . "assets/carserv/");

include "../app/init.php";


//show(ASSETS);

$app = new App();

