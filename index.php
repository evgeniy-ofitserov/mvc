

<?php

// Подключаемся к БД
require ('config.php');
require ('database.php');
require ('models/films.php');

$link = db_connect();

$films = films_all($link);


// Подключаем шаблоны страницы

include ('views/head.tpl');
include ('views/index.tpl');
include ('views/footer.tpl');




$errors = array();                  //для переменной errors -  создаем пустой массив




// Удаление фильма

if ($_GET) {                                // Если есть $_GET запрос, тогда проверяем. Если $_GET['action'] == 'delete') тогда удаляем фильм
    if ($_GET['action'] == 'deleted') {
    $query = "DELETE FROM `films` WHERE id= ' ". mysqli_real_escape_string($link, $_GET['id'] ) ."' LIMIT 1 ";  // DELETE FROM `films` WHERE id= удалить из таблицы где ID = $_GET[id]

    mysqli_query($link,$query);

    if (mysqli_affected_rows($link) > 0) { // возвращает последний элемент (DELETED)
        $info = "Фильм  удален!";
    }

    }
}


?>
