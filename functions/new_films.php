<?php 


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






?>