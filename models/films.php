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


    // подкл. файл new_films.php
    require_once("functions/new_films.php");


    // Запись данных в БД

    $query = "INSERT INTO `films` (`title`, `genre`, `years`, `description`,`photo`) VALUES (
		'".mysqli_real_escape_string($link,$title)."',  
		'".mysqli_real_escape_string($link,$genre )."',  
		'".mysqli_real_escape_string($link,$years )."' ,
        '".mysqli_real_escape_string($link,$description )."',
        '". mysqli_real_escape_string($link, $db_file_name) ."'
        
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

function films_update($link,$title,$genre,$years, $id, $description){

    $db_file_name = '';
// echo "<pre>";

// print_r($_FILES);

// echo "</pre>";

    // Делаем проверку передана ли нам картинка

if ( isset($_FILES['photo']['name']) && $_FILES['photo']['tmp_name'] != ""  ) {

    // Записываем полученный результат в переменные 

    $fileName = $_FILES["photo"]["name"];
    $fileTmpLoc = $_FILES["photo"]["tmp_name"];
    $fileType =  $_FILES["photo"]["type"];
    $fileSize =  $_FILES["photo"]["size"];
    $fileErrorMsg =  $_FILES["photo"]["error"];
    $kaboom = explode(".", $fileName);
    $fileExt = end($kaboom);

    // Проверяем высоту и ширину картинки
    list($width, $height) = getimagesize($fileTmpLoc);
    if($width < 10 || $height < 10){
        $errors[] = '';
    }

  
    //  Получаем случайное имя картинки

    $db_file_name = rand(1000000, 9999999) . "." . $fileExt;
    if($fileSize > 10485760) {
        $errors[] = 'Картинка не может превышать более 10мб';
    } else if (!preg_match("/\.(gif|jpg|png|jpeg)$/i", $fileName) ) {
        $errors[] = 'Выберите поддерживаемый формат gif, jpg, png, jpeg';
    } else if ($fileErrorMsg == 1) {
        $errors[] = 'В загрузке обнаружены ошибки';
    }

    // Указываем путь сохранения картинки

    $photoFolderLocation = ROOT . 'data/films/full/';
    $photoFolderLocationMin = ROOT . 'data/films/min/';
  

    $uploadfile = $photoFolderLocation . $db_file_name;
    $moveResult = move_uploaded_file($fileTmpLoc, $uploadfile);

    if ($moveResult != true) {
        $errors[] = 'File upload failed';
    }

    // Поделючаем библиотеку

    require_once( ROOT . "/functions/image_resize_imagick.php");


    $target_file =  $photoFolderLocation . $db_file_name;


    $resized_file = $photoFolderLocationMin . $db_file_name;


    $wmax = 137;
    $hmax = 200;
    $img = createThumbnail($target_file, $wmax, $hmax);
    $img->writeImage($resized_file);

}


    $query="UPDATE films 
            SET title='".mysqli_real_escape_string($link,$title)."',
                genre='".mysqli_real_escape_string($link,$genre)."',
                years='".mysqli_real_escape_string($link,$years)."',
                description='".mysqli_real_escape_string($link,$description)."',
                photo='".mysqli_real_escape_string($link,$db_file_name)."'

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