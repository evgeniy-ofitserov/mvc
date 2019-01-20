

    <div class="title-1">Фильмотека</div>
    <?php
        foreach ($films as $key => $value) {
    ?>
    <div class="card mb-20">
		<div class="row">
				<div class="col-auto">
					<img height="200" src="<?=HOST?>data/films/min/<?=$films[$key]['photo']?>">
				</div>	

            <div class="col-10">
                    <div class="card__top">
                            <h4 class="title-4"><?=@$films[$key]['title']?></h4>
                            <div>
                                    <?php 
                                    if( isset($_SESSION['user']) ){
                                        if($_SESSION['user'] == 'admin')  {    
                                ?>
                                        <a href="edit.php?action=edit&id=<?=$films[$key]['id']?>" class="button button--editsmall">Редактировать</a>
                                        <a href="index.php?action=deleted&id=<?=$films[$key]['id']?>" class="button button--removesmall">Удалить</a>
        
                        <?php 
                                        }
        
                                    }
                                ?> 
                                <a href="single.php?&id=<?=$films[$key]['id']?>" class="button button--moresmall">Подробнее</a>
                            </div>
                
        
                        </div>
                        <div class="badge"><?=@$films[$key]['genre']?></div>
                        <div class="badge"><?=@$films[$key]['years']?></div>
                    </div>
            </div>
            </div>
         
    <?php
        }
    ?>
