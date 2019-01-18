<h1>Укажите данные</h1>

<form action="set-cookie.php" method="post">

    <div class="form-group"><label class="label">Ваше имя<input class="input" name="user-name" type="text" placeholder="Введите имя" /></label></div>
    <div class="form-group"><label class="label">Ваш город<input class="input" name="user-city" type="text" placeholder="Введите город" /></label></div>
    <input class="button mb-20" type="submit" name="user-submit" value="Сохранить" />

</form>

<form action="unset-cookie.php" method="post">
        <input class="button" type="submit" name="cookie-delete" value="Удалить" />
    </form>
