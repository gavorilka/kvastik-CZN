
<?php

    function clearDir($dir){
        if(file_exists($dir)){
            $files = glob($dir.'*');
            if(count($files)>0){
                // foreach(glob($dir.'*') as $file){
                //     unlink($file);
                // }
                array_map('unlink', $files);
            }
            //var_dump(glob($dir.'*'));
            rmdir($dir);
        }
    }  
    
    if(!empty($_GET['del'])){
        $post_id = (int)$_GET['del'];
        $catalog = $startDir.$ds."img".$ds."posts".$ds.$post_id.$ds;
        //echo $catalog;
        $prepareParam = ['id' => $post_id];
        $sql = "DELETE FROM `post` WHERE `id` = :id";
        $post = $con->createComand($sql,$prepareParam);
        clearDir($catalog);
    }
    
    $posts = $con->createComand(" SELECT `post`.*,`user`.`login`,`user`.`isadmin` FROM `post` LEFT JOIN `user` ON `post`.`user_id` = `user`.`id` WHERE  `user_id` = {$_SESSION["isAuth"]->id};")->findAll();
    //var_dump($posts);
?>
        <?php if(isset($_SESSION["isAuth"]) && $_SESSION["isAuth"]->isadmin == 1):?>
        <section class="article-container">
            <form class="post">
                <h3>Администрирование</h3>
                <input class="form-input" type="text" name="siteName" placeholder="Новое название сайта">

                <input class="form-input" type="number" name="paginationCount" placeholder="Количество отображаемых постов на странице">
                <div class="file-container">
                    <label class="file-label" for="siteLogo">
                      <i class="material-icons">attach_file</i>
                      <span class="title">Новый логотип</span>
                      <input class="form-input" type="file" name="siteLogo" id="siteLogo">
                    </label>
                </div>
                <button class="form-button primary">Изменить</button>
            </form>
        </section>
        <?php endif;?>
        <section class="article-container">
        <?php foreach($posts as $post): ?>
            <article class="post">
                <div>
                    <a class="form-button info" href="update?<?=$post->id ?>">Редактировать</a>
                    <a class="form-button danger" href="?del=<?=$post->id ?>&user<?=$_SESSION["isAuth"]->id?>">Удалить</a>
                </div>
                <header class="post__heading">
                    <h2 class="post__title"><?=$post->title?></h2>
                    <h3 class="post__subtitle"><?=$post->sub_title?></h3>
                    <?php if(isset($_SESSION["isAuth"]) && $_SESSION["isAuth"]->isadmin == 1):?>
                        <p class="post__login"><?=$post->login?></p>
                    <?php endif; ?>
                    <p class="post__date"><?=$post->create_date?></p>
                </header>
                <figure class="post__img">
                    <img class="post__img" alt="example" src="<?=$post->picture_url?>">
                </figure>
                <p class="post__annotation post__title"><strong>Резюме<str></p>
                <p class="post__annotation"><?=$post->description?></p>
                <p class="post__annotation post__title">Полный текст</p>
                <p class="post__annotation"><?=$post->text?></p>
            </article>
        <?php endforeach; ?>
        </section>
