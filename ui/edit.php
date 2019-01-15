<?php 

// Подключаемся к БД


$link=mysqli_connect('localhost','root','','wd04-filmoteka-ofitserov');
 
if (mysqli_connect_error()) {
	die("Ошибка подключения к БД.");
}

$resaultOK = "";
$resaultNo = "";


$errors=array();


// Проверяем форму по  name="update-film"

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

    $query="UPDATE films 
            SET title='".mysqli_real_escape_string($link,$_POST['title'])."',
                genre='".mysqli_real_escape_string($link,$_POST['genre'])."',
                years='".mysqli_real_escape_string($link,$_POST['years'])."' 
            WHERE id=".mysqli_real_escape_string($link, $_GET['id'])." LIMIT 1";
            
    if ( mysqli_query($link, $query)) {
        $resaultOK = 'Фильм добавлен!';
        
    }else {
        $resaultNo = 'Фильм не добавлен';
    }
}
}

$query="SELECT * FROM  `films`  WHERE id='".mysqli_real_escape_string($link, $_GET['id'])."'LIMIT 1";

$result=mysqli_query($link,$query); 

if ($result=mysqli_query($link,$query)) {
	$film=mysqli_fetch_array($result);
}

 ?>

<!DOCTYPE html>
<html lang="ru">
<title>Евгений Офицеров - Фильмотека</title>
<head>
	<meta charset="UTF-8" />
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

        <div class="title-1">Фильм <?=$film['title']?></div>

		<div class="panel-holder mt-0 mb-40">
            <div class="title-3 mt-0">Редактировать фильм</div>
			<form action="edit.php?id=<?=$film['id']?>" method="post">

				<?php 
				if ( !empty($errors) ) {
					foreach ($errors as $key => $value) {
						echo "<div class='notify notify--error mb-20'>$value</div>";
					}
				}
				?>
		
				<div class="form-group"><label class="label">Название фильма<input class="input" name="title" type="text" placeholder="Введите название фильма" value="<?=$film['title']?>" /></label></div>
				<div class="row">
					<div class="col">
						<div class="form-group"><label class="label">Жанр<input class="input" name="genre" type="text" placeholder="Введите жанр фильма" value="<?=$film['genre']?>"  /></label></div>
					</div>
					<div class="col">
						<div class="form-group"><label class="label">Год<input class="input" name="years" type="text" placeholder="Введите год выпуска" value="<?=$film['years']?>"  /></label></div>
					</div>
				</div><input class="button" type="submit" name="update-film" value="Обновить информацию" />
			</form>
		</div>

	</div><!-- build:jsLibs js/libs.js -->
	<script src="libs/jquery/jquery.min.js"></script><!-- endbuild -->
	<!-- build:jsVendor js/vendor.js -->
	<script src="libs/jquery-custom-scrollbar/jquery.custom-scrollbar.js"></script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIr67yxxPmnF-xb4JVokCVGgLbPtuqxiA"></script><!-- endbuild -->
	<!-- build:jsMain js/main.js -->
	<script src="js/main.js"></script><!-- endbuild -->
	<script defer="defer" src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</body>

</html>