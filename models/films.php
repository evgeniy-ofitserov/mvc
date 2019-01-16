<?php


//Функция возвращает массив со всеми фильмами

function films_all($link){
    $query = "SELECT * FROM `films`";
    $films = array();
    $resault = mysqli_query($link,$query);

    if (mysqli_query($link,$query)) {                   // запрос получает из БД данные, и записываем их в переменную
        $resault = mysqli_query($link,$query);          // возвращает результат

        while ($row = mysqli_fetch_array($resault)) {   // цикл while  mysqli_fetch_array, возвращает следующий ряд из таб.
            $films[] = $row;

        }
    }

    return $films;
}


function films_new($link,$title,$genre,$years, $description){


    // Запись данных в БД

    $query = "INSERT INTO `films` (`title`, `genre`, `years`, `description`) VALUES (
		'".mysqli_real_escape_string($link,$title)."',  
		'".mysqli_real_escape_string($link,$genre )."',  
		'".mysqli_real_escape_string($link,$years )."' ,
        '".mysqli_real_escape_string($link,$description )."'  
		)";

        $resault = '';

         if (mysqli_query($link, $query)){
             $resault = true;

         }else{
             $resault = false;
             die(mysqli_error($link));
         }

         return true;
}

function get_film($link, $id){
    $query="SELECT * FROM  `films`  WHERE id='".mysqli_real_escape_string($link, $id) ."'LIMIT 1";

    $result=mysqli_query($link,$query);

    if ($result=mysqli_query($link,$query)) {
        $film=mysqli_fetch_array($result);
    }
    return $film;
}

function films_update($link,$title,$genre,$years, $id){

    $query="UPDATE films 
            SET title='".mysqli_real_escape_string($link,$title)."',
                genre='".mysqli_real_escape_string($link,$genre)."',
                years='".mysqli_real_escape_string($link,$years)."' 
            WHERE id=".mysqli_real_escape_string($link, $id)." LIMIT 1";

    if ( mysqli_query($link, $query)) {
        $result = true;

    }else {
        $result = false;
    }
    return $result;
}


function films_delete($link,$id)
{
    $query = "DELETE FROM `films` WHERE id= ' ". mysqli_real_escape_string($link, $id ) ."' LIMIT 1 ";  // DELETE FROM `films` WHERE id= удалить из таблицы где ID = $_GET[id]
    mysqli_query($link,$query);

    if (mysqli_affected_rows($link) > 0) { // возвращает последний элемент (DELETED)
        $info = "Фильм  удален!";
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}