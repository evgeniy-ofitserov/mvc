<?php


require ('config.php');



if (isset($_POST['cookie-delete'])) {

    $userName = '';
    $userCity = '';

    $expire = time() - 1;

    setcookie('user-name', $userName, $expire );
    setcookie('user-city', $userCity, $expire );


}

header('Location: ' . HOST .'request.php');







?>