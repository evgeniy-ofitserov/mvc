<?php

require ('config.php');

unset($_SESSION['user']);

session_destroy();

setcookie('userLogin', '', time() -1 );

header('Location: ' . HOST .'index.php');


?>