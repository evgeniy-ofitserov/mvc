
    <div class="title-1">Информация о фильме</div>

    <div class="card mb-20">
        <div class="row">
            <div class="col-auto">
					<img src="<?=HOST?>data/films/min/<?=$film['photo']?>" alt="<?=$film['title']?>">
                  
            </div>

        <div class="col">
                <div class="card__top">
                        <h4 class="title-4"><?=$film['title']?></h4>
                        <div>
                            <a href="index.php?action=deleted&id=<?=$film['id']?>" class="button button--removesmall">Удалить</a>
                            <a href="edit.php?action=edit&id=<?=$film['id']?>" class="button button--editsmall">Редактировать</a>
            
                        </div>
                    </div>
                    <div class="badge"><?=$film['genre']?></div>
                    <div class="badge"><?=$film['years']?></div>
                    <div class="mt-20" ><?=$film['description']?></div>
        </div>
        </div>



    </div>
