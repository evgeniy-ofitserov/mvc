<?php 


// если форма отправлена, тогда в переменные записываем пост массив, и запускаем куки
require ('config.php');

require ('functions\login_functions.php');




include ('views/head.tpl');
include ('views/request.tpl');
include ('views/footer.tpl');



?>
