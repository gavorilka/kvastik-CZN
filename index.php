<?php
    session_start();

    use Core\Conn;
    
    spl_autoload_register();
    mb_internal_encoding("UTF-8");
    error_reporting(E_ALL);
    ini_set("display_errors","on");

    $con = new Conn;
    include "core/auth.php";


    //var_dump( $_SESSION["isAuth"]);


    $sql ="INSERT INTO `user` (`login`,`password`) VALUES (:name, :pass)";
    //$test->connect->query($sql);
    //$test->createComand($sql,[':name'=>"Pit",':pass'=>"12345"]);
   
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
        <form method ="POST" name="authorization" class="header__form">
            <?php if(!isset($_SESSION["isAuth"])){ ?>
            <input class="form-input" placeholder="логин" name="login" type="text">
            <input class="form-input" placeholder="пароль" name="password" type="password">
            <button class="form-button primary" name="comeIn" value="check">Войти</button>
            <button class="form-button" name="register" value="check">Присоединиться</button>
            <?php  } else { ?>
            <button class="form-button" name="logout" value="check">Выйти</button>
            <?php } ?>
        </form>
    </header>
    <main class="main">
    <?php 
        // echo"<pre>";
        // var_dump( $urlParam);
        // echo"</pre>";
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
    <aside class="attention" <?= isset($_SESSION["error"]) ? 'style="visibility: visible;"':''; ?>>
        <p><?php if(isset($_SESSION["error"])) echo $_SESSION["error"]?></p>
    </aside>
</body>
</html>