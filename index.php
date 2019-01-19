<?php

// Подключаемся к БД
require ('config.php');
require ('database.php');
require ('models/films.php');

require ('functions\login_functions.php');


$link = db_connect();

// Удаление фильма

if ($_GET) {                                // Если есть $_GET запрос, тогда проверяем. Если $_GET['action'] == 'delete') тогда удаляем фильм
    if ($_GET['action'] == 'deleted') {

   $result = films_delete($link, $_GET['id']);

    if ($result) { // возвращает последний элемент (DELETED)
        $info = "Фильм  удален!";
    }else {
        $infoError = "Че то не то..";
    }

    }
}


$films = films_all($link);


// Подключаем шаблоны страницы

include ('views/head.tpl');
include ('views/notification.tpl');
include ('views/index.tpl');
include ('views/footer.tpl');




$errors = array();                  //для переменной errors -  создаем пустой массив

?>
