<?php


require ('config.php');
require ('database.php');
$link = db_connect();

require ('models/films.php');

// Добавление фильма
if (array_key_exists('newFilm', $_POST) ) {
    // обработка ошибок
    if ($_POST['title'] == '') {
        $errors[] = "Введите название фильма";

    }
    if ($_POST['genre'] == '') {
        $errors[] = "Введите жанр фильма";          // записываем ошибки в массив

    }
    if ($_POST['years'] == '') {
        $errors[] = "Введите год выпуска фильма";

    }

    if (empty($errors)) {

        $result = '';


      $result =  films_new($link, $_POST['title'], $_POST['genre'], $_POST['years'], $_POST['description']);

        if ($result){
            $resaultOK = "Фильм добавлен";

        }else{
            $resaultNo = "Фильм не добавлен";
        }

    }



}

include ('views/head.tpl');
include ('views/notification.tpl');
include ('views/new-film.tpl');
include ('views/footer.tpl');



?>

