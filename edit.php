<?php

require ('config.php');
require ('database.php');
$link = db_connect();



require ('models/films.php');
require ('functions\login_functions.php');

if (array_key_exists('update-film',$_POST)) {                    // если форма  была отправлена, тогда обновляем данные


    // Обработка ошибок

    if ($_POST['title']=='') {
        $errors[]="Введите название фильма!";
    }
    if ( $_POST['genre'] == '') {
        $errors[] = "Введите жанр фильма";          // записываем ошибки в массив
    }
    if ( $_POST['years'] == '') {
        $errors[] = "Введите год выпуска фильма";
    }


    if (empty($errors)) {

        $result = '';

        $result =  films_update($link, $_POST['title'], $_POST['genre'], $_POST['years'], $_GET['id'],$_POST['description']);

        if ($result){
            $resaultOK = "Фильм добавлен";

        }else{
            $resaultNo = "Фильм не добавлен";
        }
    }
}


$film = get_film($link, $_GET ['id']);


include ('views/head.tpl');
include ('views/notification.tpl');
include ('views/edit-film.tpl');
include ('views/footer.tpl');



?>
