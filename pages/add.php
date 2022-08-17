    <?php
    $postId = 1;

    function createDirectory(int $postId, $startDir){
        $ds = DIRECTORY_SEPARATOR;
        $uploaddir = $startDir.$ds."img".$ds."posts".$ds.$postId.$ds;
        if(!is_dir($uploaddir)){
            if (!mkdir($uploaddir, 0777, true)) {
                die('Не удалось создать директории...');
            }
        }
        return $uploaddir;
    }
    function addFile($postId,$startDir){
        $uploaddir = createDirectory($postId,$startDir);
       
        //var_dump($_FILES['img']);
        if(isset($_FILES['img']) && $_FILES['img']['error'] == '0'){
            $uploadfile = $uploaddir . basename($_FILES['img']['name']);

            if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile)) {
                //echo "Файл корректен и был успешно загружен.\n";
                return basename($_FILES['img']['name']);
            } else {
                echo "Возможная атака с помощью файловой загрузки!\n";
            }
        }
        
    }


    if($uri == "update"){
        if((int)$urlParam[1]){
            $post = $con->createComand("SELECT `post`.*,`user`.`login` FROM `post` LEFT JOIN `user` ON `post`.`user_id` = `user`.`id` WHERE `post`.`id` = :param;",['param'=>$urlParam[1]])->findOne();
        } else {
            header("HTTP/1.1 404 Not Found");
            header("Location: /404");
        }
    }
    if(!empty($_POST['title']) && isset($_POST['subtitle']) && isset($_POST['resume']) && isset($_POST['fulltext'])){
        if(empty($_POST['old_img']) && $uri == "add"){
            //create
            //echo"create";
            
            $sql = "INSERT INTO `post`(`user_id`, `title`, `sub_title`, `description`, `text`) VALUES (?,?,?,?,?)";
            $param =[
                $_SESSION["isAuth"]->id,
                $_POST['title'],
                $_POST['subtitle'],
                $_POST['resume'],
                $_POST['fulltext'],
            ];
            //$imgPath = "img/posts/$postId/";
            
            $post = $con->createComand($sql,$param);
            $postId =  $post->connect->lastInsertId('post');

            $imgPath = "img/posts/$postId/".addFile($postId,$startDir);

            $sql = "UPDATE `post` SET `picture_url`= ? WHERE `id` = ?";
            $param =[
                $imgPath,
                $postId
            ];
            $post = $con->createComand($sql,$param);
            // unset($_POST);
            // unset($_FILES);
        } else {
            //update
            //unlink(string $filename, ?resource $context = null): bool //для удаления файла
        }
        //echo"Успешно добавлено";
        unset($_POST['title']);
        unset($_POST['subtitle']);
        unset($_POST['resume']);
        unset($_POST['fulltext']);
        unset($_FILES['img']);
        var_dump($_POST);
    }

    
    ?>
    <style type="text/css">
        figure {
            max-width: 280px;
        }
    </style>

        <section class="article-container">
            <article class="post">
                <form class="post__heading" method ="POST" enctype="multipart/form-data">
                    <fieldset class="form-group">
                        <input class="form-input" name="title" type="text" <?= $uri == "update" ? 'value="'.$post->title.'"':'';?> placeholder="Заголовок" required>
                        <input class="form-input" name="subtitle" type="text" <?= $uri == "update" ? 'value="'.$post->sub_title.'"':'';?> placeholder="Подзаголовок" required>
                    </fieldset>
                    <fieldset class="form-group">
                        <?php if($uri == "update"):?>
                        <figure class="post__img">
                            <img class="post__img" alt="example" src="<?=$post->picture_url?>">
                        </figure>
                        <input type="hidden" name="old_img" value="<?=$post->picture_url?>">
                        <?php endif;?>
                        <div class="file-container">
                            <label class="file-label" for="img">
                                <i class="material-icons">attach_file</i>
                                <span class="title">Новое изображение</span>
                                <input class="form-input" type="file" name="img" id="img">
                            </label>
                        </div>
                    </fieldset>
                    <fieldset class="form-group">
                        <input class="form-input" name="resume" type="text"  <?= $uri == "update" ? 'value="'.$post->description.'"':'';?> placeholder="Резюме" required>
                        <textarea class="form-input" name ="fulltext"  placeholder="Текст" required><?= $uri == "update" ? $post->text:'';?></textarea>
                    </fieldset>
                    <button class="form-button primary">Сохранить</button>
                </form>
            </article>
        </section>
    