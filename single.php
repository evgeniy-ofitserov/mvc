<?php

// Подключаемся к БД
require ('config.php');
require ('database.php');
require ('models/films.php');

$link = db_connect();

require ('functions\login_functions.php');



// Удаление фильма

if (!$_GET) {                                // Если есть $_GET запрос, тогда проверяем. Если $_GET['action'] == 'delete') тогда удаляем фильм
    if ($_GET['action'] == 'deleted') {

   $result = films_delete($link, $_GET['id']);

    if ($result) { // возвращает последний элемент (DELETED)
        $info = "Фильм  удален!";
    }else {
        $infoError = "Че то не то..";
    }

    }
}

$film = get_film($link, $_GET['id']);


// echo "<pre>";
// print_r($film);
// echo "</pre>";


// Подключаем шаблоны страницы

include ('views/head.tpl');
include ('views/notification.tpl');
include ('views/film-single.tpl');
include ('views/footer.tpl');

$errors = array();                  //для переменной errors -  создаем пустой массив

