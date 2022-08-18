
<section class="article-container">
<?php
if((int)$urlParam[1]){
    $post = $con->createComand("SELECT `post`.*,`user`.`login` FROM `post` LEFT JOIN `user` ON `post`.`user_id` = `user`.`id` WHERE `post`.`id` = :param;",['param'=>$urlParam[1]])->findOne();

    if(!empty($_POST["comment"])){
        $con->createComand("INSERT INTO `coments`(`post_id`, `user_id`, `text`) VALUES (:post_id,:user_id,:text);",['post_id'=>$urlParam[1],'user_id' =>$_SESSION["isAuth"]->id,'text'=>htmlspecialchars($_POST["comment"])]);
        unset($_POST["comment"]);    
    }

    $coments = $con->createComand("SELECT `coments`.*, `user`.`login` FROM `coments` LEFT JOIN `user` ON `coments`.`user_id` = `user`.`id` WHERE `post_id` = :param;",['param'=>$urlParam[1]])->findAll();
    
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
        <form name="addComment" method="POST">
            <input class="form-input" type="text" name="comment" placeholder="текст комментария">
            <button class="form-button primary">Отправить</button>
        </form>
    </section>
    <?php }?>
    <section>
        <h3>Комментарии</h3>
        <?php 
            if($coments){ 
                foreach($coments as $coment):
        ?>
        <article class="comment">
            <p class="post__login"><?=$coment->login?></p>
            <p class="post__annotation"><?=$coment->text?></p>
        </article>
        <?php 
                endforeach;
            } else{
                echo "Коментариев нет";  
            }
        ?>
    </section>
</section>
