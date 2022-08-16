
<section class="article-container">
<?php
if((int)$urlParam[1]){
    $post = $con->createComand("SELECT `post`.*,`user`.`login` FROM `post` LEFT JOIN `user` ON `post`.`user_id` = `user`.`id` WHERE `post`.`id` = :param;",['param'=>$urlParam[1]])->findOne();
} else {
    header("HTTP/1.1 404 Not Found");
    header("Location: /404");
}
?>
    <article class="post">
        <header class="post__heading">
            <h2 class="post__title"><?=$post->title?></h2>
            <h3 class="post__subtitle"><?=$post->sub_title?></h3>
            <p class="post__login"><?=$post->login?></p>
            <p class="post__date"><?=$post->create_date?></p>
        </header>
        <figure class="post__img">
            <img class="post__img" alt="example" src="<?=$post->picture_url?>">
        </figure>
        <p class="post__annotation"><?=$post->text?></p>
        <form>
            <button class="post__like">
                <img src="img/like.png" alt="like">
            </button>
        </form>
    </article>
</section>
<section class="comment-container">
    <?php if(isset($_SESSION["isAuth"])){ ?>
    <section>
        <h3>Добавить комментарий</h3>
        <form name="addComment">
            <input class="form-input" type="text" name="comment" placeholder="текст комментария">
            <button class="form-button primary">Отправить</button>
        </form>
    </section>
    <?php }?>
    <section>
        <h3>Комментарии</h3>
        <article class="comment">
            <p class="post__login">login@loginovich</p>
            <p class="post__annotation">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet commodi deleniti distinctio dolorem dolorum eos est, eveniet ipsa molestiae natus nobis officiis, praesentium quae reiciendis unde velit, voluptates? Necessitatibus, voluptatem.</p>
        </article>
    </section>
</section>
