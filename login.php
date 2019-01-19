<?php


// Делаем проверку Если форма отправлена записываем переменные 
// $userName $userPassword, и если login == admin 
// и пароль = 123456 


require ('config.php');

require ('functions\login_functions.php');


if ( isset($_POST['enter'] )) {
    $userName = 'admin';
    $userPassword = '123456';

    if ( $_POST['login'] == $userName) {

        if ($_POST['password'] == $userPassword) {

            $_SESSION['user'] = 'admin';

            header('Location: ' . HOST .'index.php');
        }

    }

}



include ('views/head.tpl');
include ('views/login.tpl');
include ('views/footer.tpl');






















?>