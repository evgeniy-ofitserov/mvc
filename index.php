

<?php 

// Подключаемся к БД
$link = mysqli_connect('localhost', 'root', '', 'wd04-filmoteka-ofitserov');

if (mysqli_connect_error($link) ) {
    die("Ошибка подключения к БД"); 
}


//Сохраняем форму данных (с сайта в нашу БД)

//print_r($_POST);
$resaultOK = "";
$resaultNo = "";
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


// Проверяем форму по  name="newFilm"
if (array_key_exists('newFilm', $_POST) ) {                                                         // если форма  была отправлена, тогда добавляем данные


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
       
    // Запись данных в БД
    $query = "INSERT INTO `films` (`title`, `genre`, `years`) VALUES (
		'".mysqli_real_escape_string($link, $_POST['title'])."',  
		'".mysqli_real_escape_string($link, $_POST['genre'])."',  
		'".mysqli_real_escape_string($link, $_POST['years'])."'  
		)";
    
        if ( mysqli_query($link, $query)) {
            $resaultOK = 'Фильм добавлен!';
           
        }else {
            $resaultNo = 'Фильм не добавлен';
        }

    }
}



$query = "SELECT * FROM `films`";  // Вывод из БД


if (mysqli_query($link,$query)) {                   // запрос получает из БД данные, и записываем их в переменную
    $resault = mysqli_query($link,$query);          // возвращает результат

    while ($row = mysqli_fetch_array($resault)) {   // цикл while  mysqli_fetch_array, возвращает следующий ряд из таб.
        $films[] = $row;

    }
}



?>


<!-- Разные миксины по одному, которые понадобятся. Для логотипа, бейджа, и т.д.-->
<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8" />
	<title>Евгений Офицеров - Фильмотека</title>
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"/><![endif]-->
	<meta name="keywords" content="" />
	<meta name="description" content="" /><!-- build:cssVendor css/vendor.css -->
	<link rel="stylesheet" href="libs/normalize-css/normalize.css" />
	<link rel="stylesheet" href="libs/bootstrap-4-grid/grid.min.css" />
	<link rel="stylesheet" href="libs/jquery-custom-scrollbar/jquery.custom-scrollbar.css" /><!-- endbuild -->
	<!-- build:cssCustom css/main.css -->
	<link rel="stylesheet" href="./css/main.css" /><!-- endbuild -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&amp;subset=cyrillic-ext" rel="stylesheet">
	<!--[if lt IE 9]><script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script><![endif]-->
</head>

<body class="index-page">
	<div class="container user-content section-page">

    <?php if ($resaultOK != '') {?>
        <div class="info"><?=$resaultOK?></div>
    <?php }?>
    <?php if ($resaultNo != '') {?>
        <div class="info"><?=$resaultNo?></div>
    <?php }?>

    <?php if (@$info != '') {?>
        <div class="notify notify--error"><?=$info?></div>
    <?php }?>

        <div class="title-1">Фильмотека</div>
    <?php
        foreach ($films as $key => $value) {
        ?>
        <div class="card mb-20">
            <div class="card__top">
            <h4 class="title-4"><?=@$films[$key]['title']?></h4>
             <div>
                <a href="index.php?action=deleted&id=<?=$films[$key]['id']?>" class="button button--removesmall">Удалить</a>
                <a href="edit.php?action=edit&id=<?=$films[$key]['id']?>" class="button button--editsmall">Редактировать</a>
            </div>
            </div>
            <div class="badge"><?=@$films[$key]['genre']?></div>
            <div class="badge"><?=@$films[$key]['years']?></div>
        </div>
    <?php
        }
    ?>
		<div class="panel-holder mt-80 mb-40">
			<div class="title-3 mt-0">Добавить фильм</div>
			<form action="index.php" method="post">

            <?php
            
            if (!empty($errors)) {
                foreach ($errors as $key => $value) {                        // Выводим полученную ошибку на экран
                    echo "<div class='notify notify--error'>" .$value."</div>";
                }
            }
            
            ?>
				<div class="form-group"><label class="label">Название фильма<input class="input" name="title" type="text" placeholder="Такси 2" /></label></div>
				<div class="row">
					<div class="col">
						<div class="form-group"><label class="label">Жанр<input class="input" name="genre" type="text" placeholder="комедия" /></label></div>
					</div>
					<div class="col">
						<div class="form-group"><label class="label">Год<input class="input" name="years" type="text" placeholder="2000" /></label></div>
					</div>
				</div><input class="button" type="submit" name="newFilm" value="Добавить" />
			</form>
		</div>
	</div><!-- build:jsLibs js/libs.js -->
	<script src="libs/jquery/jquery.min.js"></script><!-- endbuild -->
    <!-- build:jsVendor js/vendor.js -->
    <script src="js/form.js"></script>
	<script src="libs/jquery-custom-scrollbar/jquery.custom-scrollbar.js"></script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIr67yxxPmnF-xb4JVokCVGgLbPtuqxiA"></script><!-- endbuild -->
	<!-- build:jsMain js/main.js -->
	<script src="js/main.js"></script><!-- endbuild -->
	<script defer="defer" src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</body>

</html>