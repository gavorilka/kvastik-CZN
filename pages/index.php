<section class="article-container">

<?php
    $posts = $con->createComand(" SELECT `post`.*,`user`.`login` FROM `post` LEFT JOIN `user` ON `post`.`user_id` = `user`.`id`;")->findAll();
    foreach($posts as $post):
?>
    <a href="single?<?=$post->id?>">
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
            <p class="post__annotation"><?=$post->description?></p>
            <form>
                <button class="post__like">
                    <img src="img/like.png" alt="like">
                </button>
            </form>
        </article>
    </a>
<?php 
    endforeach;
?>
    <!-- <a href="single.html">
        <article class="post">
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
            <form>
                <button class="post__like">
                    <img src="img/like.png" alt="like">
                </button>
            </form>
        </article>
    </a> -->
</section>
<form class="pagination">
    <button class="pagination__button">&LeftTeeArrow;</button>
    <p class="pagination__page-number">1</p>
    <button class="pagination__button">&RightTeeArrow;</button>
</form>

