

<h1 class="title-1">Добавить новый фильм</h1>

<div class="panel-holder mt-20 mb-40">
    <div class="title-3 mt-0"></div>
    <form action="new.php" method="post">

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
        </div>
        <textarea name="description" class="textarea mb-20" placeholder="Введите описание"></textarea>
        <input class="button" type="submit" name="newFilm" value="Добавить" />
    </form>
</div>
</div><!-- build:jsLibs js/libs.js -->