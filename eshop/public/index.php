<?php

session_start();



$a = $_SERVER['REQUEST_SCREME'] . "://". $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] .$_SERVER['PHP_SELF'];
$a = str_replace("index.php", "", $a);
include "../app/init.php";
show($a);
$app = new App();

