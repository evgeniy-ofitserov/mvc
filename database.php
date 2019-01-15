<?php
// Функция подключения к бд

function db_connect(){
    $link = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASS, MYSQL_DB);

    if (mysqli_connect_error($link) ) {
        die("Ошибка подключения к БД");
    }

   $charset = mysqli_set_charset($link, "utf8");

    if ($charset === false){
      print_r("Error " . mysqli_connect_error($link));
    }

    return $link;
}