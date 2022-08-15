<?php
    use Core\Conn;
    
    spl_autoload_register();

    $test = new Conn;
    
    $sql ="INSERT INTO `user` (`login`,`password`) VALUES (:name, :pass)";
    //$test->connect->query($sql);
    $test->createComand($sql,[':name'=>"Pit",':pass'=>"12345"]);
    mb_internal_encoding("UTF-8");
    error_reporting(E_ALL);
    ini_set("display_errors","on");
    //phpinfo();
    
    //var_dump($_SERVER);
    // var_dump($_SERVER["REQUEST_URI"]);
    // var_dump($_SERVER["SERVER_NAME"]);
    // var_dump($_SERVER["DOCUMENT_ROOT"]);
    
    $uri = $_SERVER["REQUEST_URI"];
    $uri = preg_replace("/\/kvestik/","",$uri); // костыль для Xampp
    //echo $uri;

    preg_match_all("/((?<=\?)|(?<=\/)|(?<=\&))\w+/",$uri,$urlParam);
    $urlParam = $urlParam[0];
    //$urlParam = preg_split("/\//",$uri);
    $uri = $urlParam[0];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Домашняя</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="page-header">
        <img src="img/logo.svg" alt="Kvestik" height="30">
        <nav class="page-nav">
            <ul>
                <li><a href="index">Домашняя</a></li>
                <li><a href="user">Профиль</a></li>
                <li><a href="add">Создать</a></li>
            </ul>
        </nav>
        <form name="authorization" class="header__form">
            <input class="form-input" placeholder="логин" name="login" type="text">
            <input class="form-input" placeholder="пароль" name="login" type="password">
            <button class="form-button primary" name="comeIn">Войти</button>
            <button class="form-button" name="register">Присоединиться</button>
            <button class="form-button" name="logout">Выйти</button>
        </form>
    </header>
    <main class="main">
    <?php 
        echo"<pre>";
        var_dump( $urlParam);
        echo"</pre>";
        switch ($uri) {
            case '':
                include "pages/index.html";
                break;
            case 'index':
                include "pages/index.html";
                break;
            case 'user':
                include "pages/user.html";
                break;
            case 'add':
                include "pages/add.html";
                break;
            case "single?{$urlParam[1]}":
                include "pages/single.html";
                break;
            default:
                echo "страница не найдена";
        }
    ?>
    </main>
    <aside class="attention">
        <p>Attention text</p>
    </aside>
</body>
</html>