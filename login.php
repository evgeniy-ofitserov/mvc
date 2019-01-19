<?php

// Делаем проверку Если форма отправлена записываем переменные 
// $userName $userPassword, и если login == admin 
// и пароль = 123456 


require ('config.php');
require ('database.php');
$link = db_connect();
require ('models/films.php');


require ('functions\login_functions.php');


if ( isset($_POST['enter'] )) {

    $user = check_admin($link, $_POST['login'], $_POST['password']);

    if ($user == false) {
        echo 'Не правильные данные';
    }else {
        
        $_SESSION['user'] = 'admin';
        header('Location: ' . HOST .'index.php');
    }
    die();


    // Запрос в БД

    check_admin($link, $_POST['login'], $_POST['password']);

}

include ('views/head.tpl');
include ('views/login.tpl');
include ('views/footer.tpl');

?>