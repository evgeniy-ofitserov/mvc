<?php 

// подкл. к бд


define('MYSQL_SERVER', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASS', '');
define('MYSQL_DB', 'wd04-filmoteka-ofitserov');


define('HOST', 'http://'. $_SERVER['HTTP_HOST'] . '/');


define('ROOT', dirname(__FILE__) . '/');

session_start();

// echo "<pre>";

// print_r($_SERVER);

// echo "</pre>";

?>