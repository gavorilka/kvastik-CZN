
<?php
    $posts = $con->createComand(" SELECT `post`.*,`user`.`login`,`user`.`isadmin` FROM `post` LEFT JOIN `user` ON `post`.`user_id` = `user`.`id` WHERE  `user_id` = {$_SESSION["isAuth"]->id};")->findAll();
    var_dump($posts);
    //foreach($posts as $post):
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
            <article class="post">
                <div>
                    <a class="form-button info" href="update?1">Редактировать</a>
                    <a class="form-button danger" href="?del">Удалить</a>
                </div>
                <header class="post__heading">
                    <h2 class="post__title">Title example</h2>
                    <h3 class="post__subtitle">Subtitle example</h3>
                    <p class="post__login">login@loginovich</p>
                    <p class="post__date">12.12.2012</p>
                </header>
                <figure class="post__img">
                    <img class="post__img" alt="example" src="img/posts/1.jpeg">
                </figure>
                <p class="post__annotation">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aliquid architecto aspernatur delectus deserunt eaque eos in maxime neque perspiciatis quas quia quidem quis, quos, reiciendis sunt tempore tenetur. Numquam?</p>
            </article>
        </section>
